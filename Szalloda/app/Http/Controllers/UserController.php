<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profile() {
        return view("profile");
    }

    public function logout() {
        Auth::logout();
        return redirect("/");
    }

    public function login() {
        return view("login");
    }

    public function loginPost(Request $request) {
        return redirect("/");
    }

    public function registration() {
        return view("registration");
    }

    public function registrationPost(Request $request) {
        return redirect("/");
    }
}
