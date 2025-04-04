<?php

namespace App\Http\Controllers;

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


class BookingController extends Controller
{
    //region Frontend
    public function Reservation_Frontend($hotel_id) {
        $hotel = Hotel::find($hotel_id);
        if ($hotel == null) {
            return redirect("/");
        }
        $service = Service::fromQuery("
            select s.service_id, sc.serviceName, s.price,s.available,s.allYear,s.startDate,s.endDate,s.openTime,s.closeTime,s.category_id
            from service s
            inner join servicecategory sc on sc.serviceCategory_id = s.category_id
            inner join hotel h on h.hotel_id = s.hotel_id
            where h.hotel_id = $hotel_id;
        ");
        $rooms = Room::fromQuery("
            select r.room_id, r.roomNumber, r.pricepernight, r.capacity
            from room r
            inner join hotel h on r.hotel_id = h.hotel_id
            where h.hotel_id = $hotel_id
        ");

        return view("reservation", [
            "hotel" => $hotel,
            "services" => $service,
            "rooms" => $rooms,
            "userLoyalty" => Loyalty::select("loyalty.rank_id", "loyaltyrank.discount", "loyaltyrank.rank")
                             ->join("loyaltyrank", "loyalty.rank_id", "loyaltyrank.rank_id")
                             ->where("user_id", Auth::user()->user_id)
                             ->first()
        ]);
    }
    //endregion

    //region Backend
    public function Reservation_Backend(Request $req) {
        $req->validate([
            'startDate' => 'required|after:now',
            'endDate' => 'required|after:startDate',
            'service_id' => 'required',

            //----------------------
            'method' => 'required',
            'country' => 'required',
            'city' => 'required',
            'zip' => 'required',
            'line1' => 'required:',
        ],[
            'stardate.after' => "A mainál korábbi dátumot nem adhat meg!",
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
        $billing->line2 = $req->line2 || "";
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
        return redirect("/szalloda/$req->hotel_id")->with('sv', 'Sikeres foglalás!');
    }

    public function CancelBooking_Backend(Request $req){
        $booking = Booking::find($req->cancel);
        $booking->status = "refund requested";
        $booking->save();

        $point = round($booking->totalPrice / 1000,0);

        $loyaltyId = Loyalty::where('user_id',Auth::user()->user_id)->get();
        $loyalty = Loyalty::find($loyaltyId[0]->loyalty_id);
        $loyalty->points -= $point;
        $loyalty->updated_at = Carbon::now('Europe/Budapest');

        $ranks = loyaltyrank::fromquery("select lr.rank_id, lr.minPoint from loyaltyrank lr");
        foreach($ranks as $r){
            if($loyalty->points > $r->minPoint){
                $loyalty->rank_id = $r->rank_id;
            }
        }
        $loyalty->save();
        return back();
    }
    //endregion

    //region API
    public function GetBookingInfo_API($hotel_id, $start, $end) {
        $year = date("Y");
        $year_next = date("Y") + 1;

        return [
            "rooms" => Room::fromQuery("
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
            "),
            "services" => Service::fromQuery("
                select s.service_id, sc.serviceName, s.price, s.available, s.allYear,
                    if (s.startDate is not null, concat('$year', right(s.startDate, 6)), s.startDate) formattedStartDate,
                    if (s.endDate is not null, if (month(s.endDate) < month(s.startDate), concat('$year_next', right(s.endDate, 6)), concat('$year', right(s.endDate, 6))), s.endDate) formattedEndDate,
                    s.openTime, s.closeTime, s.category_id
                from service s
                inner join servicecategory sc on sc.serviceCategory_id = s.category_id
                inner join hotel h on h.hotel_id = s.hotel_id
                where
                    h.hotel_id = $hotel_id
                having
                    s.allYear = 1
                    or
                    if('$start' > formattedStartDate, '$start', formattedStartDate) <= if('$end' < formattedEndDate, '$end', formattedEndDate)
                ;
            ")
        ];
    }
    //endregion
}
