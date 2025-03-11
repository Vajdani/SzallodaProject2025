<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\City;
use App\Models\Hotel;
use App\Models\Room;
use Illuminate\Http\Request;

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

        return view("hotel", [
            "hotel" => $hotel,
            "rooms" => Room::where("hotel_id", $id)->get(),
            "city" => City::find($hotel->city_id),
            "reviews" => Review::fromQuery("
                select reviews.rating, reviews.created_at, reviews.reviewText, hotel.hotelName, user.username, user.profilePic, user.user_id, user.active
                from reviews, hotel, user
                where
                    reviews.hotel_id = hotel.hotel_id and
                    reviews.user_id = user.user_id and
                    hotel.hotel_id = $id
                "),
        ]);
    }

    public function city($id) {
        return view("city", [
            "city" => City::find($id),
            "hotels" => Hotel::fromQuery("
                select hotel.hotelName, hotel.hotel_id, hotel.address, hotel.phoneNumber, hotel.email, round(round(avg(reviews.rating)*2,0)/2,1) as rating, count(reviews.rating) as ratingCount
                from hotel left join reviews on hotel.hotel_id = reviews.hotel_id
                where hotel.city_id = $id
                group by hotel.hotel_id;
            "),
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
            "reviews" => Review::fromQuery("
                select reviews.rating, reviews.created_at, reviews.reviewText, hotel.hotelName, user.username, user.profilePic, user.user_id, user.active
                from reviews, hotel, user
                where
                    reviews.hotel_id = hotel.hotel_id and
                    reviews.user_id = user.user_id"
            ),
            "cities" => City::all(),
            "hotels" => Hotel::all()
        ]);
    }

    public function reviewsFilter($stars, $city, $hotel) {
        $reviewQuery = "
            select reviews.rating, reviews.created_at, reviews.reviewText, hotel.hotelName, user.username, user.profilePic, user.active
            from reviews, hotel, user
            where
                reviews.hotel_id = hotel.hotel_id and
                reviews.user_id = user.user_id";

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
