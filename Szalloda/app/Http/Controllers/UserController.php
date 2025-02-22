<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    static int $minPasswordLength = 8;

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
        $request->validate([
            "name" => "required|unique:user,username",
            "lastName" => "required",
            "firstName" => "required",
            "email" => [
                "required",
                "regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/",
                "unique:user,email"
            ],
            "phonenumber" => "required|min:10|max:15",
            "password" => [
                "required",
                Password::min(self::$minPasswordLength)->letters()->mixedCase()->numbers()->symbols(),
                "confirmed"
            ],
            "password_confirmation" => "required",
            "date" => "required|date",
            "tos" => "required",
        ], [
            "name.required" => "Muszáj megadnia a felhasználónevét!",
            "name.unique" => "Ez a felhasználónév már foglalt!",

            "lastName.required" => "Muszáj megadnia a vezetéknevét!",
            "firstName.required" => "Muszáj megadnia a keresztnevét!",

            "email.required" => "Muszáj megadnia az e-mail címét!",
            "email.regex" => "Nem e-mail címet adott meg!",
            "email.unique" => "Ezzel az e-mail címmel már regisztrált fiókot!",

            "phonenumber.required" => "Muszály megadnia a telefonszámát!",
            "phonenumber.min" => "A telefonszámnak legalább 10 számjegy hosszúnak kell lennie!",
            "phonenumber.max" => "A telefonszám legfeljebb 15 számjegy hosszú lehet!",

            "password.required" => "Muszáj megadnia a jelszavát!",
            "password.min" => "A jelszónak legalább ".self::$minPasswordLength." karakter hosszúnak kell lennie!",
            "password.letters" => "A jelszónak betűket is tartalmaznia kell!",
            "password.mixedCase" => "A jelszónak kis- és nagybetűket is tartalmaznia kell!",
            "password.numbers" => "A jelszónak számokat is tartalmaznia kell!",
            "password.symbols" => "A jelszónak speciális karaktereket is tartalmaznia kell!",

            "password_confirmation.required" => "Muszáj megerősítenie a jelszavát!",

            "date.required" => "Muszáj megadnia a születési dátumát!",

            "tos.required" => "Muszáj elfogadnia a felhasználói feltételeket!",
        ]);

        $user = new User;
        $user->username = $request->name;
        $user->lastName = $request->lastName;
        $user->firstName = $request->firstName;
        $user->birthDate = $request->date;
        $user->phonenumber = $request->phonenumber;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->userType = "guest";
        $user->active = true;
        $user->Save();

        return redirect("/");
    }

    public function changePassword() {
        return view("changePassword");
    }

    public function changePasswordPost(Request $request) {
        return redirect("/");
    }


    public function deleteAccount() {
        return view("deleteAccount");
    }

    public function deleteAccountPost(Request $request) {
        return redirect("/");
    }
}
