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
        return view("city");
    }

    public function reservation() {
        return view("reservation");
    }

    public function reservationPost(Request $request) {
        return redirect("/");
    }

    public function reviews() {
        return view("reviews",[
            "reviews" => Reviews::fromQuery("select reviews.rating, reviews.created_at, reviews.reviewText, hotel.hotelName, user.username from reviews, hotel, user where reviews.hotel_id = hotel.hotel_id and reviews.user_id = user.user_id"),
            "cities" => Varos::all(),
            "hotels" => Hotel::all()
        ]);
    }

    public function reviewsFilter($csillagok, $varos, $hotel) {
        $query = "select reviews.rating, reviews.created_at, reviews.reviewText, hotel.hotelName, user.username from reviews, hotel, user where reviews.hotel_id = hotel.hotel_id and reviews.user_id = user.user_id";

        if ($csillagok != 0) { $query .= " and reviews.rating = $csillagok"; }
        if ($varos != 0) { $query .= " and hotel.city_id = $varos"; }
        if ($hotel != 0) { $query .= " and reviews.hotel_id = $hotel"; }

        return Reviews::fromQuery($query);
    }
}
