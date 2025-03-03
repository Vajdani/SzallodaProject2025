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
            "hotels" => Hotel::fromQuery("select hotel.hotelName, hotel.address, hotel.phoneNumber, hotel.email, avg(reviews.rating) as rating from hotel, reviews where hotel.hotel_id = $id and hotel.hotel_id = reviews.hotel_id group by hotel.hotel_id, hotel.hotelName")
        ]);
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
