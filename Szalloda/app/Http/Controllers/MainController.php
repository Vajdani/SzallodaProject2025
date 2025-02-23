<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index() {
        return view("index");
    }

    public function reviews($id) {
        return view("reviews");
    }

    public function hotel($id) {
        return view("hotel");
    }

    public function city($id) {
        return view("city");
    }
    public function success(){
        return view("success");
    }



    public function reservation() {
        return view("reservation");
    }

    public function reservationPost(Request $request) {
        return redirect("/");
    }
}
