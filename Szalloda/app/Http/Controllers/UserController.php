<?php




namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Review;
use App\Models\Hotel;
use App\Rules\RealNameRule;
use Carbon\Carbon;


class UserController extends Controller
{
    static int $minPasswordLength = 8;

    public function review(){
        return view("review", [
            "hotels" => Hotel::all()
        ]);
    }

    public function reviewById($id){
        return view("review", [
            "hotel" => Hotel::find($id)
        ]);
    }

    public function reviewPost(Request $req){
        $req->validate([
            'hotel' => 'required',
            'star' => 'required',
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

    public function profile() {
        return UserController::profileByID(Auth::user()->user_id);
    }

    public function profileByID($id) {
        return view("profile", [
            "user" => User::find($id),
            "reviews" => Review::fromQuery("
                select r.rating, r.created_at, r.reviewText, h.hotelName, h.hotel_id, u.username, u.profilePic, u.user_id, u.active
                from reviews r
                inner join user u on u.user_id = r.user_id
                inner join hotel h on r.hotel_id = h.hotel_id
                where u.user_id like $id
            ")
        ]);
    }


    public function profilePost(Request $req) {
        $req->validate([
            'username' => 'required',
            'realname' => [
                'required',
                new RealNameRule()
            ],
            "email" => [
                "required",
                "regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/"
            ]
        ], [
            "username.required" => "Muszáj megadnia a felhasználónevét!",

            "realname.required" => "Muszáj megadnia a polgári nevét!",

            "email.required" => "Muszáj megadnia az e-mail címét!",
            "email.regex" => "Nem egy e-mail címet adott meg!"
        ]);
        $data = User::find(Auth::user()->user_id);
        $data->username = $req->username;
        $nev = explode(' ', $req->realname, 2);
        $data->lastName = $nev[0];
        $data->firstName = $nev[1];
        $data->email = $req->email;
        $data->Save();

        return redirect("/profil");
    }

    public function profilePfp(Request $req){
        $data = User::find(Auth::user()->user_id);
        $data->profilePic = $req->pfp;
        $data->save();

        return redirect("/profil");
    }

    public function logout() {
        Auth::logout();
        return redirect("/")->with('sv', 'Sikeres kijelentkezés!');
    }

    public function login() {
        return view("login");
    }

    public function loginPost(Request $req) {
        $req->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        if(Auth::attempt(['username' => $req->username, 'password' => $req->password, "active" => true]) ||
           Auth::attempt(['email' => $req->username, 'password' => $req->password, "active" => true])) {
            return redirect('/')->with("sv", "Sikeres bejelentkezés!");
        }
        else{
            return redirect('/bejelentkezes');
        }
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
            "phonenumber" => "required|min:10|max:15|unique:user,phonenumber",
            "password" => [
                "required",
                Password::min(self::$minPasswordLength)->letters()->mixedCase()->numbers()->symbols(),
                "confirmed"
            ],
            "password_confirmation" => "required",
            "date" => "required|date|before:".Carbon::now()->subYears(18),
            "tos" => "required",
        ], [
            "name.required" => "Muszáj megadnia a felhasználónevét!",
            "name.unique" => "Ez a felhasználónév már foglalt!",

            "lastName.required" => "Muszáj megadnia a vezetéknevét!",
            "firstName.required" => "Muszáj megadnia a keresztnevét!",

            "email.required" => "Muszáj megadnia az e-mail címét!",
            "email.regex" => "Nem e-mail címet adott meg!",
            "email.unique" => "Ezzel az e-mail címmel már regisztrált fiókot!",


            "phonenumber.required" => "Muszáj megadnia a telefonszámát!",
            "phonenumber.min" => "A telefonszámnak legalább 10 számjegy hosszúnak kell lennie!",
            "phonenumber.max" => "A telefonszám legfeljebb 15 számjegy hosszú lehet!",
            "phonenumber.unique" => "Ez a telefonszám már más által használva van!",

            "password.required" => "Muszáj megadnia a jelszavát!",
            "password.min" => "A jelszónak legalább ".self::$minPasswordLength." karakter hosszúnak kell lennie!",
            "password.letters" => "A jelszónak betűket is tartalmaznia kell!",
            "password.mixed" => "A jelszónak kis- és nagybetűket is tartalmaznia kell!",
            "password.numbers" => "A jelszónak számokat is tartalmaznia kell!",
            "password.symbols" => "A jelszónak speciális karaktereket is tartalmaznia kell!",

            "password_confirmation.required" => "Muszáj megerősítenie a jelszavát!",

            "date.required" => "Muszáj megadnia a születési dátumát!",
            "date.date" => "Valós dátumot adjon meg!",
            "date.before" => "Csak 18 évnél idősebb személy regisztrálhat!",

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

        return redirect("/bejelentkezes");
    }

    public function changePassword() {
        return view("changePassword");
    }

    public function changePasswordPost(Request $req) {
        $req->validate([
            'password'      => 'required',
            'newpassword'  => [
                'required',
                Password::min(8)
                        ->numbers()
                        ->letters()
                        ->mixedCase()
                        ->symbols(),
                'confirmed'
            ],
            'newpassword_confirmation' => 'required',
        ], [
            'password.required'     => 'A jelszó megadása kötelező',
            'newpassword.required'  => 'Az új Jelszó megadása kötelező',
            'newpassword.min'       => 'Legalább 8 karakter legyen az új jelszó!',
            'newpassword.numbers'   => 'Az új jelszónak tartalmaznia kell számot',
            'newpassword.letters'   => 'Az új jelszónak tartalmaznia kell betűt',
            'newpassword.mixed'     => 'Az új jelszónak kell tartalmazni kis és nagybetűt is!',
            'newpassword.symbols'   => 'Az új jelszónak kell tartalmazni speciális karaktert!',
            'newpassword.confirmed' => 'A két új jelszónak meg kell egyeznie'
        ]);

        if(Hash::check($req->password,Auth::user()->password)){
            $data = User::find(Auth::user()->user_id);
            $data->password    = Hash::make($req->newpassword);
            $data->Save();
            Auth::logout();
            return redirect('/bejelentkezes')->with([
                'sv'=>'A jelszava megváltozott!'
            ]);
        }
        else {
            return redirect('/profil')->with([
                'sv'=>'A jelszó nem változott meg!'
            ]);
        }
    }

    public function deleteAccount() {
        return view("deleteAccount");
    }

    public function deleteAccountConfirm() {
        $user = User::find(Auth::user()->user_id);
        $user->active = false;
        $user->Save();

        Auth::logout();

        return redirect("/");
    }
}
