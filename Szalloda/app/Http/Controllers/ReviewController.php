<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\City;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Rules\MaxCommentLengthRule;

class ReviewController extends Controller
{
    //region Class properties
    public static int $maxCommentLength = 1000;
    //endregion

    //region Frontend
    public function AllReviews_Frontend() {
        return view("reviews",[
            "reviews" => Review::fromQuery("
                select
                    reviews.rating, reviews.created_at, reviews.reviewText, hotel.hotelName,
                    hotel.hotel_id, user.username, user.profilePic, user.user_id, user.active,
                    reviews.review_id, reviews.edited
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

    public function PostReview_Frontend() {
        $data = ReviewController::CanWriteReview(Auth::user()->user_id);

        if ($data[0]) {
            return view("review", [
                "hotels" => $data[1]
            ]);
        }
        else {
            return back()->with("sv", "Még nem tudsz értékléseket írni!");
        }
    }

    public function PostReviewByID_Frontend($hotel_id) {
        $user_id = Auth::user()->user_id;
        $data = ReviewController::CanWriteReviewForHotel($hotel_id, $user_id);

        if (!$data[0]) {
            return back()->with("sv", "Még nem tudsz értékléseket írni!");
        }

        return view("review", [
            "hotel" => $data[1]
        ]);
    }

    public function ModifyReview_Frontend($review_id) {
        $review = Review::find($review_id);
        if ($review == null) {
            return redirect("/");
        }

        return view("review", [
            "hotel" => Hotel::find($review->hotel_id),
            "review" => $review
        ]);
    }
    //endregion

    //region Backend
    public function PostReview_Backend(Request $req) {
        $req->validate([
            'hotel' => 'required',
            'star' => 'required',
            "comment" => "max:".self::$maxCommentLength
        ], [
            'hotel.required' => 'Muszáj választania egy szállodát!',
            'star.required' => 'Muszáj értékelnie a szállodát!',
        ]);

        $review = new Review;
        $review->user_id = Auth::user()->user_id;
        $review->hotel_id = $req->hotel;
        $review->rating = $req->star;
        $review->reviewText = $req->comment;
        $review->created_at = Carbon::now('Europe/Budapest');
        $review->Save();

        return redirect("/szalloda/$req->hotel");
    }

    public function ModifyReview_Backend(Request $req, $review_id) {
        $req->validate([
            'hotel' => 'required',
            'star' => 'required',
            "comment" => [
                new MaxCommentLengthRule()
            ]
        ], [
            'hotel.required' => 'Muszáj választania egy szállodát!',
            'star.required' => 'Muszáj értékelnie a szállodát!',
        ]);

        $review = Review::find($review_id);
        $review->rating = $req->star;
        $review->reviewText = $req->comment;
        $review->created_at = Carbon::now('Europe/Budapest');
        $review->edited = 1;
        $review->Save();

        return redirect("/szalloda/$req->hotel");
    }

    public function DeleteReview_Backend($review_id) {
        $review = Review::find($review_id);
        $review->active = 0;
        $review->Save();

        return back();
    }
    //endregion

    //region Util
    public static function CanWriteReviewForHotel($hotel_id, $user_id) {
        $hotel = Hotel::fromQuery("
            select hotel.hotel_id, hotel.hotelName
            from hotel
            inner join room on room.hotel_id = hotel.hotel_id
            inner join booking on room.room_id = booking.room_id
            where
                hotel.hotel_id = $hotel_id and
                booking.user_id = $user_id and
                booking.status = 'completed'
            having (
                select count(*)
                from reviews
                where
                    reviews.user_id = $user_id and
                    reviews.hotel_id = hotel.hotel_id and
                    reviews.active = 1
                ) < count(booking.booking_id)
        ");

        $authorized = count($hotel) > 0;
        return [$authorized, $authorized ? $hotel[0] : null];
    }

    public static function CanWriteReview($user_id) {
        $hotels = Hotel::fromQuery("
            select distinct hotel.hotel_id, hotel.hotelName
            from hotel
            inner join room on room.hotel_id = hotel.hotel_id
            inner join booking on room.room_id = booking.room_id
            where
                booking.user_id = $user_id and
                booking.status = 'completed'
            group by hotel.hotel_id
            having (
                select count(*)
                from reviews
                where
                    reviews.user_id = $user_id and
                    reviews.hotel_id = hotel.hotel_id and
                    reviews.active = 1
                ) < count(booking.booking_id)
        ");

        $authorized = count($hotels) > 0;
        return [$authorized, $authorized ? $hotels : null];
    }
    //endregion

    //region API
    public function GetFilteredReviews_API($stars, $city_id, $hotel_id) {
        $reviewQuery = "
            select
                reviews.rating, reviews.created_at, reviews.reviewText, hotel.hotelName,
                hotel.hotel_id, user.username, user.profilePic, user.user_id, user.active,
                reviews.review_id, reviews.edited
            from reviews, hotel, user
            where
                reviews.hotel_id = hotel.hotel_id and
                reviews.user_id = user.user_id and
                reviews.active = 1
        ";

        if ($stars <= 5 && $stars >= 1) { $reviewQuery .= " and reviews.rating = $stars"; }
        if ($city_id != 0 && City::find($city_id) != null) { $reviewQuery .= " and hotel.city_id = $city_id"; }
        if ($hotel_id != 0 && Hotel::find($hotel_id) != null) { $reviewQuery .= " and reviews.hotel_id = $hotel_id"; }

        $reviewQuery .= " order by reviews.created_at";

        $response = [
            "reviews" => Review::fromQuery($reviewQuery),
        ];

        $hotelQuery = "select hotelName, hotel_id from hotel";
        if ($city_id != 0) {
            $hotelQuery .= " where city_id = $city_id";
        }

        $response["hotels"] = Hotel::fromQuery($hotelQuery);

        return $response;
    }
    //endregion
}
