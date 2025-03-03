<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsLoggedIn;
use App\Http\Middleware\IsntLoggedIn;

Route::get('/', [MainController::class, "index"]);
Route::get('/ertekelesek', [MainController::class, "reviews"]);
//Route::get('/ertekelesek/ertek/{csillagok}/varos/{varos}/szalloda/{hotel}', [MainController::class, "reviewsFilter"]);
Route::get('/ertekelesek/{csillagok}/{varos}/{hotel}', [MainController::class, "reviewsFilter"]);
Route::get('/szalloda/{id}', [MainController::class, "hotel"]);
Route::get('/telepules/{id}', [MainController::class, "city"]);
Route::get('/foglalas', [MainController::class, "reservation"]);
Route::post('/foglalas', [MainController::class, "reservationPost"]);

Route::group(['middleware' => [IsLoggedIn::class]], function () {
    Route::get('/kijelentkezes', [UserController::class, "logout"]);
    Route::get('/profil', [UserController::class, "profile"]);
    Route::post('/profil/adat', [UserController::class, "profilePost"]);
    Route::post('/profil/pfp', [UserController::class, "profilePfp"]);
    Route::get('/ertekeles', [UserController::class, "review"]);
    Route::post('/ertekeles', [UserController::class, "reviewPost"]);
    Route::get('/jelszovaltoztatas', [UserController::class, "changePassword"]);
    Route::post('/jelszovaltoztatas', [UserController::class, "changePasswordPost"]);
    Route::get('/fioktorles', [UserController::class, "deleteAccount"]);
    Route::post('/fioktorles', [UserController::class, "deleteAccountPost"]);
    Route::get('/fioktorles/megerositem', [UserController::class, "deleteAccountConfirm"]);
});

Route::group(['middleware' => [IsntLoggedIn::class]], function () {
    Route::get('/bejelentkezes', [UserController::class, "login"]);
    Route::post('/bejelentkezes', [UserController::class, "loginPost"]);
    Route::get('/regisztracio', [UserController::class, "registration"]);
    Route::post('/regisztracio', [UserController::class, "registrationPost"]);
});
