<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\City;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\Service;
use App\Models\Booking;
use App\Models\Billing;
use App\Models\Loyalty;
use App\Models\LoyaltyRank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class MainController extends Controller
{
    public function index() {
        return view("index",[
            "cities" => City::all()
        ]);
    }

    public function randomHotel() {
        return MainController::hotel(rand(1, Hotel::max("hotel_id")));
    }

    public function hotel($id) {
        $hotel = Hotel::find($id);
        if ($hotel == null) {
            return redirect("/");
        }
        $desc = hotel::find($id)->description;
        $desc = explode('{break}', $desc);
        $oceanfloor = array("Teknős","Bohóchal","Cápa","Horgászhal");

        return view("hotel", [
            "hotel" => $hotel,
            "rooms" => Room::where("hotel_id", $id)->get(),
            "city" => City::find($hotel->city_id),
            "reviews" => Review::fromQuery("
                select reviews.rating, reviews.created_at, reviews.reviewText, hotel.hotelName, hotel.hotel_id, user.username, user.profilePic, user.user_id, user.active, reviews.review_id
                from reviews, hotel, user
                where
                    reviews.hotel_id = hotel.hotel_id and
                    reviews.user_id = user.user_id and
                    hotel.hotel_id = $id and
                    reviews.active = 1
                order by reviews.created_at
                "),
            "services" => Service::fromQuery("
                select servicecategory.serviceName, service.price, service.available, service.allYear, service.startDate, service.endDate, service.openTime, service.closeTime
                from service, servicecategory
                where
                    service.hotel_id = $id and
                    service.category_id = servicecategory.serviceCategory_id
            "),
            "city_description" => City::find($hotel->city_id)->description_short,
            "hotel_description" => $desc,
            "oceanfloor" => $oceanfloor
        ]);
    }

    public function city($id) {
        if (city::find($id) == null) {
            return redirect("/");
        }
        $desc = City::find($id)->description;
        $desc = explode('{break}', $desc);

        return view("city", [
            "city" => City::find($id),
            "hotels" => Hotel::fromQuery("
                select hotel.hotelName, hotel.hotel_id, hotel.address, hotel.phoneNumber, hotel.email, (
                    select round(avg(reviews.rating), 1)
                    from reviews
                    where
                        hotel.hotel_id = reviews.hotel_id and
                        reviews.active = 1
                    ) as rating, (
                    select count(reviews.rating)
                    from reviews
                    where
                        hotel.hotel_id = reviews.hotel_id and
                        reviews.active = 1
                    ) as ratingCount,
                    hotel.description
                from hotel
                where
                    hotel.city_id = $id
                group by hotel.hotel_id;
            "),
            "description" => $desc
        ]);
    }

    public function reservationById($id) {
        $hotel = Hotel::find($id);
        if ($hotel == null) {
            return redirect("/");
        }
        $service = Service::fromQuery("
            select s.service_id, sc.serviceName, s.price,s.available,s.allYear,s.startDate,s.endDate,s.openTime,s.closeTime,s.category_id
            from service s
            inner join servicecategory sc on sc.serviceCategory_id = s.category_id
            inner join hotel h on h.hotel_id = s.hotel_id
            where h.hotel_id = $id;
        ");
        $rooms = Room::fromQuery("
            select r.room_id, r.roomNumber, r.pricepernight, r.capacity
            from room r
            inner join hotel h on r.hotel_id = h.hotel_id
            where h.hotel_id = $id
        ");

        return view("reservation", [
            "hotel" => $hotel,
            "services" => $service,
            "rooms" => $rooms
        ]);
    }

    public function reservationPost(Request $req) {

        $req->validate([
            'startDate' => 'required',
            'endDate' => 'required|after:startDate',
            'service_id' => 'required',

            //----------------------
            'method' => 'required',
            'country' => 'required',
            'city' => 'required',
            'zip' => 'required',
            'line1' => 'required',
            'line2' => 'required'


        ],[
            'startDate.required' => 'Adja meg a kezdő dátumot!',
            'endDate.required' => 'adja meg a vég dátumot!',
            'endDate.after' => 'A kezdő dátum nem lehet korábban mint a végdátum!',
            'service_id.required' => 'válasszon ellátást!',

            //--------------------
            'method.required' => 'Válasszon fizetési módot!',
            'country.required' => 'Adja meg az országot!',
            'city.required' => 'Adja meg a várost!',
            'zip.required' => 'Adja meg az irányítószámot!',
            'line1.required' => 'Adja meg az első címsort!',
            'line2.required' => 'Adja meg a második címsort!'
        ]);

        $start = Carbon::parse($req->input('startDate'));
        $end = Carbon::parse($req->input('endDate'));
        $days = $start->diffInDays($end, false);

        $room_id = $req->room_id;
        $price = Room::find($room_id)->pricepernight * $days;

        $services = [];
        $service_id = $req->service_id;
        if ($service_id != 0) {
            $price += Service::find($service_id)->price * $days;
            array_push($services, $service_id);
        }

        if ($req->services != null) {
            foreach($req->services as $s){
                $price += Service::find($s)->price;
                array_push($services, $s);
            }
        }
        $loyaltyId = Loyalty::where('user_id',Auth::user()->user_id)->get();
        $loyalty = Loyalty::find($loyaltyId[0]->loyalty_id);
        $loyaltyrank = LoyaltyRank::find($loyalty->rank_id);
        $discount = 100-$loyaltyrank->discount;
        $price *= $discount/100;



        $booking = new Booking;
        $booking->user_id = Auth::user()->user_id;
        $booking->room_id = $room_id;
        $booking->bookStart = $req->startDate;
        $booking->bookEnd = $req->endDate;
        $booking->status = "confirmed";
        $booking->totalPrice = $price;
        $booking->services = implode("-", $services);
        $booking->save();

        $billing = new Billing;
        $billing->booking_id = $booking->booking_id;
        $billing->amount = $price;
        $billing->BookingDate = Carbon::now('Europe/Budapest');
        if($req->method=="cash"){
            $billing->paymentDate = "";
        }
        else{
            $billing->paymentDate = Carbon::now('Europe/Budapest');
        }
        $billing->paymentMethod = $req->method;
        $billing->country = $req->country;
        $billing->city = $req->city;
        $billing->zipcode = $req->zip;
        $billing->line1 = $req->line1;
        $billing->line2 = $req->line2;
        $billing->save();


        $point = round($price / 1000,0);

        $loyaltyId = Loyalty::where('user_id',Auth::user()->user_id)->get();
        $loyalty = Loyalty::find($loyaltyId[0]->loyalty_id);
        $loyalty->points += $point;
        $loyalty->updated_at = Carbon::now('Europe/Budapest');

        $ranks = loyaltyrank::fromquery("select lr.rank_id, lr.minPoint from loyaltyrank lr");
        foreach($ranks as $r){
            if($loyalty->points > $r->minPoint){
                $loyalty->rank_id = $r->rank_id;
            }
        }
        $loyalty->save();
        return redirect("/szalloda/$req->hotel_id");
    }

    public function reviews() {
        return view("reviews",[
            "reviews" => Review::fromQuery("
                select reviews.rating, reviews.created_at, reviews.reviewText, hotel.hotelName, hotel.hotel_id, user.username, user.profilePic, user.user_id, user.active, reviews.review_id
                from reviews, hotel, user
                where
                    reviews.hotel_id = hotel.hotel_id and
                    reviews.user_id = user.user_id and
                    reviews.active = 1
                order by reviews.created_at
            "),
            "cities" => City::all(),
            "hotels" => Hotel::all()
        ]);
    }

    public function reviewsFilter($stars, $city, $hotel) {
        $reviewQuery = "
            select reviews.rating, reviews.created_at, reviews.reviewText, hotel.hotelName, hotel.hotel_id, user.username, user.profilePic, user.active, reviews.review_id
            from reviews, hotel, user
            where
                reviews.hotel_id = hotel.hotel_id and
                reviews.user_id = user.user_id and
                reviews.active = 1
            order by reviews.created_at
            ";

        if ($stars <= 5 && $stars >= 1) { $reviewQuery .= " and reviews.rating = $stars"; }
        if ($city != 0 && City::find($city) != null) { $reviewQuery .= " and hotel.city_id = $city"; }
        if ($hotel != 0 && Hotel::find($hotel) != null) { $reviewQuery .= " and reviews.hotel_id = $hotel"; }

        $response = [
            "reviews" => Review::fromQuery($reviewQuery),
        ];

        $hotelQuery = "select hotelName, hotel_id from hotel";
        if ($city != 0) {
            $hotelQuery .= " where city_id = $city";
        }

        $response["hotels"] = Hotel::fromQuery($hotelQuery);

        return $response;
    }

    public function unoccupiedRooms($hotel_id, $start, $end) {
        return Room::fromQuery("
            select r.room_id, r.roomNumber, r.pricepernight, r.capacity
            from room r
            inner join hotel h on r.hotel_id = h.hotel_id
            where
                h.hotel_id = $hotel_id and
                r.roomNumber not in (
                    select r.roomNumber
                    from room r
                    inner join booking b on b.room_id = r.room_id
                    where if('$start' > b.bookStart, '$start', b.bookStart) <= if('$end' < b.bookEnd, '$end', b.bookEnd)
                );
        ");
    }
}
