<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\City;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;


//Gizike12+
class MainController extends Controller
{
    //region Frontend
    public function MainPage_Frontend() {
        return view("index",[
            "cities" => City::all()
        ]);
    }

    public function RandomHotel_Frontend() {
        return MainController::Hotel_Frontend(Hotel::inRandomOrder()->first()->hotel_id);
    }

    public function Hotel_Frontend($hotel_id) {
        $hotel = Hotel::find($hotel_id);
        if ($hotel == null) {
            return redirect("/");
        }
        $desc = hotel::find($hotel_id)->description;
        $desc = explode('{break}', $desc);

        return view("hotel", [
            "hotel" => $hotel,
            "rooms" => Room::where("hotel_id", $hotel_id)->get(),
            "city" => City::find($hotel->city_id),
            "reviews" => Review::fromQuery("
                select
                    reviews.rating, reviews.created_at, reviews.reviewText, hotel.hotelName,
                    hotel.hotel_id, user.username, user.profilePic, user.user_id, user.active,
                    reviews.review_id, reviews.edited
                from reviews, hotel, user
                where
                    reviews.hotel_id = hotel.hotel_id and
                    reviews.user_id = user.user_id and
                    hotel.hotel_id = $hotel_id and
                    reviews.active = 1
                order by reviews.created_at
            "),
            "services" => Service::fromQuery("
                select servicecategory.serviceName, service.price, service.available, service.allYear, service.startDate, service.endDate, service.openTime, service.closeTime
                from service, servicecategory
                where
                    service.hotel_id = $hotel_id and
                    service.category_id = servicecategory.serviceCategory_id
            "),
            "city_description" => City::find($hotel->city_id)->description_short,
            "hotel_description" => $desc,
            "writeReviews" => ReviewController::CanWriteReviewForHotel($hotel_id, Auth::check() ? Auth::user()->user_id : -1)[0]
        ]);
    }

    public function City_Frontend($city_id) {
        if (city::find($city_id) == null) {
            return redirect("/");
        }
        $desc = City::find($city_id)->description;
        $desc = explode('{break}', $desc);

        return view("city", [
            "city" => City::find($city_id),
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
                    hotel.city_id = $city_id
                group by hotel.hotel_id;
            "),
            "description" => $desc
        ]);
    }
    //endregion
}
