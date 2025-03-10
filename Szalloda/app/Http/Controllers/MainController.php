<?php

namespace App\Http\Controllers;

use App\Models\Reviews;
use App\Models\Varos;
use App\Models\hotel as Hotel;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index() {
        return view("index",[
            "varos" => Varos::all()
        ]);
    }

    public function hotel($id) {
        return view("hotel");
    }

    public function city($id) {
        return view("city", [
            "city" => Varos::find($id),
            "hotels" => Hotel::fromQuery("
                                        select hotel.hotelName, hotel.hotel_id, hotel.address, hotel.phoneNumber, hotel.email, round(round(avg(reviews.rating)*2,0)/2,1) as rating, count(reviews.rating) as ratingCount
                                        from hotel left join reviews on hotel.hotel_id = reviews.hotel_id
                                        where hotel.city_id = $id
                                        group by hotel.hotel_id;"),

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
            return redirect("/foglalas");
        }

        return view("reservation", [
            "hotel_id" => $id,
            "hotelName" => $hotel->hotelName
        ]);
    }

    public function reservationPost(Request $request) {
        return redirect("/");
    }

    public function reviews() {
        return view("reviews",[
            "reviews" => Reviews::fromQuery("select reviews.rating, reviews.created_at, reviews.reviewText, hotel.hotelName, user.username, user.profilePic, user.user_id from reviews, hotel, user where reviews.hotel_id = hotel.hotel_id and reviews.user_id = user.user_id"),
            "cities" => Varos::all(),
            "hotels" => Hotel::all()
        ]);
    }

    public function reviewsFilter($csillagok, $varos, $hotel) {
        $reviewQuery = "select reviews.rating, reviews.created_at, reviews.reviewText, hotel.hotelName, user.username, user.profilePic from reviews, hotel, user where reviews.hotel_id = hotel.hotel_id and reviews.user_id = user.user_id";

        if ($csillagok != 0) { $reviewQuery .= " and reviews.rating = $csillagok"; }
        if ($varos != 0) { $reviewQuery .= " and hotel.city_id = $varos"; }
        if ($hotel != 0) { $reviewQuery .= " and reviews.hotel_id = $hotel"; }

        $response = [
            "reviews" => Reviews::fromQuery($reviewQuery),
        ];

        $hotelQuery = "select hotelName, hotel_id from hotel";
        if ($varos != 0) {
            $hotelQuery .= " where city_id = $varos";
        }

        $response["hotels"] = Hotel::fromQuery($hotelQuery);

        return $response;
    }
}
