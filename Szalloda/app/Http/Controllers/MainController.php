<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\City;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\Service;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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
                    select round(round(avg(reviews.rating)*2,0)/2,1)
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

    public function reservation() {
        return view("reservation", [
            "hotels" => Hotel::all()->select("hotel_id", "hotelName")
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
        $start = "2025-03-15";
        $end = "2025-03-16";    
        $rooms = Room::fromQuery("
                select * from room r
                inner join hotel h on r.hotel_id = h.hotel_id
                where h.hotel_id = $id
                and r.roomNumber not in (
                select r.roomNumber
                from room r
                inner join booking b on b.room_id = r.room_id
                where '$start' BETWEEN b.bookStart and b.bookEnd
                or '$end' BETWEEN b.bookStart and b.bookEnd);
        ");

        return view("reservation", [
            "hotel" => $hotel,
            "services" => $service,
            "room" => $rooms
        ]);
    }

    public function reservationPost(Request $req) {
        $req->validate([
            'startDate' => 'required',
            'endDate' => 'required|after:startDate',
            'ellatas' => 'required'
        ],[
            'startDate.required' => 'Adja meg a kezdő dátumot!',
            'endDate.required' => 'adja meg a vég dátumot!',
            'endDate.after' => 'A kezdő dátum nem lehet korábban mint a végdátum!',
            'ellatas.required' => 'válasszon ellátást!'
        ]);

        $start= \Carbon\Carbon::parse($req->input('startDate'));
        $end = \Carbon\Carbon::parse($req->input('endDate'));
        $days = $start->diffInDays($end, false);

        $tomb = explode('|', $req->rooms);
        $room=$tomb[0];
        $price=$tomb[1];
        $price = $price * $days;
    
        $tomb=explode('|',$req->ellatas);
        $service_id = $tomb[0];
        $price = $price + ($tomb[1]*$days);

        $service_string = $service_id."-";
        if($req->services==null){

        }
        else{
            foreach($req->services as $s){
                $price = $price + service::find($s)->price;
                $service_string = $service_string . $s;
                $service_string = $service_string . "-";
            }
        }   
        $service_string = substr($service_string,0,-1);  
        $data = new booking;
        $data->user_id = Auth::user()->user_id;
        $data->room_id = $room;
        $data->bookStart = $req->startDate;
        $data->bookEnd = $req->endDate;
        $data->status = "confirmed";
        $data->totalPrice = $price;
        $data->services = $service_string;
        $data->save();
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
}
