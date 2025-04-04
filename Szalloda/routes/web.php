<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsLoggedIn;
use App\Http\Middleware\IsntLoggedIn;

Route::get ('/',                                            [MainController::class,     "MainPage_Frontend"]);
Route::get ('/ertekelesek',                                 [ReviewController::class,   "AllReviews_Frontend"]);
Route::get ('/ertekelesek/{csillagok}/{varos}/{hotel}',     [ReviewController::class,   "GetFilteredReviews_API"]);
Route::get ('/szalloda/veletlenszeru',                      [MainController::class,     "RandomHotel_Frontend"]);
Route::get ('/szalloda/{id}',                               [MainController::class,     "Hotel_Frontend"]);
Route::get ('/telepules/{id}',                              [MainController::class,     "City_Frontend"]);
Route::get ('/profil/{id}',                                 [UserController::class,     "ProfileByID_Frontend"]);
Route::get ("/foglalas/info/{id}/{start}/{end}",            [BookingController::class,  "GetBookingInfo_API"]);
Route::view('/felhasznaloi_feltetetel',                     'tos');

Route::group(['middleware' => [IsLoggedIn::class]], function () {
    Route::get ('/kijelentkezes',               [UserController::class,     "Logout_Backend"]);
    Route::get ('/profil',                      [UserController::class,     "Profile_Frontend"]);
    Route::post('/profil/adat',                 [UserController::class,     "UpdateProfileDetails_Backend"]);
    Route::post('/profil/pfp',                  [UserController::class,     "SetNewPFP_Backend"]);
    Route::post('/profil/lemond',               [BookingController::class,  "CancelBooking_Backend"]);
    Route::get ('/ertekeles',                   [ReviewController::class,   "PostReview_Frontend"]);
    Route::get ('/ertekeles/{id}',              [ReviewController::class,   "PostReviewByID_Frontend"]);
    Route::post('/ertekeles',                   [ReviewController::class,   "PostReview_Backend"]);
    Route::get ('/jelszovaltoztatas',           [UserController::class,     "ChangePassword_Frontend"]);
    Route::post('/jelszovaltoztatas',           [UserController::class,     "ChangePassword_Backend"]);
    Route::get ('/fioktorles',                  [UserController::class,     "DeleteAccount_Frontend"]);
    Route::post('/fioktorles/megerositem',      [UserController::class,     "DeleteAccount_Backend"]);
    Route::get ('/ertekelestorles/{id}',        [ReviewController::class,   "DeleteReview_Backend"]);
    Route::get ('/ertekelesmodositas/{id}/',    [ReviewController::class,   "ModifyReview_Frontend"]);
    Route::post('/ertekelesmodositas/{id}/',    [ReviewController::class,   "ModifyReview_Backend"]);
    Route::get ('/foglalas/{id}',               [BookingController::class,  "Reservation_Frontend"]);
    Route::post('/foglalas',                    [BookingController::class,  "Reservation_Backend"]);
});

Route::group(['middleware' => [IsntLoggedIn::class]], function () {
    Route::get ('/bejelentkezes',   [UserController::class, "Login_Frontend"]);
    Route::post('/bejelentkezes',   [UserController::class, "Login_Backend"]);
    Route::get ('/regisztracio',    [UserController::class, "Registration_Frontend"]);
    Route::post('/regisztracio',    [UserController::class, "Registration_Backend"]);
});
