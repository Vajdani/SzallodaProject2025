<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsLoggedIn;
use App\Http\Middleware\IsntLoggedIn;

Route::get('/', [MainController::class, "index"]);
Route::get('/ertekelesek', [MainController::class, "reviews"]);
Route::get('/ertekelesek/{csillagok}/{varos}/{hotel}', [MainController::class, "reviewsFilter"]);
Route::get('/szalloda/veletlenszeru', [MainController::class, "randomHotel"]);
Route::get('/szalloda/{id}', [MainController::class, "hotel"]);
Route::get('/telepules/{id}', [MainController::class, "city"]);
Route::get('/profil/{id}', [UserController::class, "profileByID"]);
Route::get("/foglalas/szabadszobak/{id}/{start}/{end}", [MainController::class, "unoccupiedRooms"]);
route::view('/felhasznaloi_feltetetel','tos');

Route::group(['middleware' => [IsLoggedIn::class]], function () {
    Route::get('/kijelentkezes', [UserController::class, "logout"]);
    Route::get('/profil', [UserController::class, "profile"]);
    Route::post('/profil/adat', [UserController::class, "profilePost"]);
    Route::post('/profil/pfp', [UserController::class, "profilePfp"]);
    Route::get('/ertekeles', [UserController::class, "review"]);
    Route::get('/ertekeles/{id}', [UserController::class, "reviewById"]);
    Route::post('/ertekeles', [UserController::class, "reviewPost"]);
    Route::get('/jelszovaltoztatas', [UserController::class, "changePassword"]);
    Route::post('/jelszovaltoztatas', [UserController::class, "changePasswordPost"]);
    Route::get('/fioktorles', [UserController::class, "deleteAccount"]);
    Route::post('/fioktorles/megerositem', [UserController::class, "deleteAccountConfirm"]);
    Route::get('/ertekelestorles/{id}', [UserController::class, "deleteReview"]);
    Route::get('/foglalas/{id}', [MainController::class, "reservationById"]);
    Route::post('/foglalas', [MainController::class, "reservationPost"]);
});

Route::group(['middleware' => [IsntLoggedIn::class]], function () {
    Route::get('/bejelentkezes', [UserController::class, "login"]);
    Route::post('/bejelentkezes', [UserController::class, "loginPost"]);
    Route::get('/regisztracio', [UserController::class, "registration"]);
    Route::post('/regisztracio', [UserController::class, "registrationPost"]);
});
