<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsLoggedIn;
use App\Http\Middleware\IsntLoggedIn;

Route::get('/', [MainController::class, "index"]);
Route::get('/ertekelesek/{id}', [MainController::class, "reviews"]);
Route::get('/szalloda/{id}', [MainController::class, "hotel"]);
Route::get('/telepules/{id}', [MainController::class, "city"]);
Route::get('/foglalas', [MainController::class, "reservation"]);
Route::post('/foglalas', [MainController::class, "reservationPost"]);

Route::group(['middleware' => [IsLoggedIn::class]], function () {
    Route::get('/kijelentkezes', [UserController::class, "logout"]);
    Route::get('/profil', [UserController::class, "profile"]);
});

Route::group(['middleware' => [IsntLoggedIn::class]], function () {
    Route::get('/bejelentkezes', [UserController::class, "login"]);
    Route::post('/bejelentkezes', [UserController::class, "loginPost"]);
    Route::get('/regisztracio', [UserController::class, "registration"]);
    Route::post('/regisztracio', [UserController::class, "registrationPost"]);
});
