<?php




namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Review;
use App\Models\Hotel;
use App\Models\Service;
use App\Rules\RealNameRule;
use App\Rules\UsernameUniqueRule;
use App\Rules\phonenumberUniqueRule;
use App\Rules\UniqueEmailRule;
use App\Models\Booking;
use App\Models\Loyalty;
use App\Models\LoyaltyRank;
use Carbon\Carbon;


class UserController extends Controller
{
    //region Class properties
    private static int $minPasswordLength = 8;
    private static int $minUserAge = 18;
    private static int $minPhoneNumberLength = 10;
    private static int $maxPhoneNumberLength = 15;
    //endregion

    //region Frontend
    public function Profile_Frontend() {
        return UserController::ProfileByID_Frontend(Auth::user()->user_id);
    }

    public function ProfileByID_Frontend($user_id) {
        if (!is_numeric($user_id)) {
            $found_id = User::select("user_id")->where("username", $user_id)->first();
            if ($found_id == null) {
                return redirect("/")->with("sv", "Nincs ilyen felhasználó!");
            }

            $user_id = $found_id->user_id;
        }

        $user = User::find($user_id);
        if ($user == null) {
            return redirect("/")->with("sv", "Nincs ilyen felhasználó!");
        }

        $services = [];
        $booking = [];
        $writeReviews = false;
        if (Auth::check() && Auth::user()->user_id == $user_id) {
            $serviceQuery = Service::fromQuery("
                select distinct service.service_id, servicecategory.serviceName, booking.booking_id
                from service
                inner join servicecategory on servicecategory.serviceCategory_id = service.category_id
                inner join booking on (
                    booking.services like concat(service.service_id, '-%') or
                    booking.services like concat('%-', service.service_id, '-%') or
                    booking.services like concat('%-', service.service_id) or
                    booking.services like service.service_id
                )
                where booking.user_id = $user_id
            ");

            foreach ($serviceQuery as $key => $item) {
                $services[$item["booking_id"]][$key] = $item;
            }

            $today = date("Y-m-d");
            $booking = Booking::fromQuery("
                select b.bookStart, b.bookEnd, b.status, b.totalPrice, r.roomNumber, h.hotelName, h.address, h.hotel_id, b.services, b.booking_id, datediff(b.bookEnd, \"$today\") as diff
                from booking b
                inner join user u on u.user_id = b.user_id
                inner join room r on r.room_id = b.room_id
                inner join hotel h on h.hotel_id = r.hotel_id
                where b.user_id like $user_id
                order by b.booking_id desc;
            ");
            $writeReviews = ReviewController::CanWriteReview($user_id)[0];
        }

        $currentRank =  Loyalty::fromQuery("
            select l.points, lr.rank, lr.rank_id, lr.minPoint,lr.perks
            from loyalty l
            inner join loyaltyrank lr on l.rank_id = lr.rank_id
            where l.user_id like $user_id
        ");
        $next ="";
        $rankid = $currentRank[0]->rank_id;
        if($rankid!=4){
            $next = loyaltyrank::fromQuery("
                select rank_id,rank,minPoint
                from loyaltyrank
                where rank_id like $rankid+1;
            ");
        }
        $perks = explode(',',$currentRank[0]->perks);

        return view("profile", [
            "user" => $user,
            // "userType" => User::fromQuery("select userType from employee where user_id = $user_id"),
            "reviews" => Review::fromQuery("
                select
                    r.rating, r.created_at, r.reviewText, h.hotelName,
                    h.hotel_id, u.username, u.profilePic, u.user_id, u.active,
                    r.review_id, r.edited
                from reviews r
                inner join user u on u.user_id = r.user_id
                inner join hotel h on r.hotel_id = h.hotel_id
                where
                    u.user_id like $user_id and
                    r.active = 1
            "),
            "booking" => $booking,
            "services" => $services,
            "loyalty" =>$currentRank,
            "nextRank" => $next,
            "perks" => $perks,
            "writeReviews" => $writeReviews
        ]);
    }

    public function Registration_Frontend() {
        return view("registration");
    }

    public function Login_Frontend() {
        return view("login");
    }

    public function ChangePassword_Frontend() {
        return view("changePassword");
    }

    public function DeleteAccount_Frontend() {
        return view("deleteAccount");
    }
    //endregion

    //region Backend
    public function Registration_Backend(Request $request) {
        $request->validate([
            "name" => [
                'required',
                'max:32',
                "unique:user,username"
            ],
            "lastName" => "required|max:50",
            "firstName" => "required|max:50",
            "email" => [
                "required",
                "regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/",
                "unique:user,email",
                "max:150",
            ],
            "phonenumber" =>[
                "required",
                "min:".self::$minPhoneNumberLength,
                "max:".self::$maxPhoneNumberLength,
                "regex:/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/",
            ],
            "password" => [
                "required",
                Password::min(self::$minPasswordLength)
                        ->letters()
                        ->mixedCase()
                        ->numbers()
                        ->symbols(),
                "confirmed"
            ],
            "password_confirmation" => "required",
            "date" => "required|date|before:".Carbon::now()->subYears(self::$minUserAge),
            "tos" => "required",
        ], [
            "name.required" => "Muszáj megadnia a felhasználónevét!",
            "name.unique" => "Ez a felhasználónév már foglalt!",
            "name.max" => "A felhasználó neve maximum 32 karakter legyen",

            "lastName.required" => "Muszáj megadnia a vezetéknevét!",
            "lastName.max" => "A vezetékneve maximum 50 karakter legyen!",
            "firstName.max" => "A keresztneve maximum 50 karakter legyen!",
            "firstName.required" => "Muszáj megadnia a keresztnevét!",

            "email.required" => "Muszáj megadnia az e-mail címét!",
            "email.regex" => "Nem e-mail címet adott meg!",
            "email.unique" => "Ezzel az e-mail címmel már regisztrált fiókot!",
            "email.max" => "Az email maximum 150 karakter hosszú legyen!",

            "phonenumber.required" => "Muszáj megadnia a telefonszámát!",
            "phonenumber.regex" => "Érvényes telefonszámot adjon meg!",
            "phonenumber.min" => "A telefonszámnak legalább ".self::$minPhoneNumberLength." számjegy hosszúnak kell lennie!",
            "phonenumber.max" => "A telefonszám legfeljebb ".self::$maxPhoneNumberLength." számjegy hosszú lehet!",
            "phonenumber.unique" => "Ez a telefonszám már más által használva van!",

            "password.required" => "Muszáj megadnia a jelszavát!",
            "password.min" => "A jelszónak legalább ".self::$minPasswordLength." karakter hosszúnak kell lennie!",
            "password.letters" => "A jelszónak betűket is tartalmaznia kell!",
            "password.mixed" => "A jelszónak kis- és nagybetűket is tartalmaznia kell!",
            "password.numbers" => "A jelszónak számokat is tartalmaznia kell!",
            "password.symbols" => "A jelszónak speciális karaktereket is tartalmaznia kell!",

            "password_confirmation.required" => "Muszáj megerősítenie a jelszavát!",
            "password.confirmed" => "A jelszavaknak egyezniük kell",

            "date.required" => "Muszáj megadnia a születési dátumát!",
            "date.date" => "Valós dátumot adjon meg!",
            "date.before" => "Csak ".self::$minUserAge." évnél idősebb személy regisztrálhat!",

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
        $user->active = true;
        $user->Save();

        $loyalty = new Loyalty;
        $loyalty->user_id = $user->user_id;
        $loyalty->rank_id = 1;
        $loyalty->points = 0;
        $loyalty->updated_at = Carbon::now('Europe/Budapest');
        $loyalty->Save();

        return redirect("/bejelentkezes")->with("sv", "Sikeres regisztráció!");
    }

    public function Login_Backend(Request $req) {
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

    public function ChangePassword_Backend(Request $req) {
        $req->validate([
            'password'      => 'required',
            'newpassword'  => [
                'required',
                Password::min(self::$minPasswordLength)
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
            'newpassword.min'       => 'Legalább '.self::$minPasswordLength.' karakter legyen az új jelszó!',
            'newpassword.numbers'   => 'Az új jelszónak tartalmaznia kell számot',
            'newpassword.letters'   => 'Az új jelszónak tartalmaznia kell betűt',
            'newpassword.mixed'     => 'Az új jelszónak kell tartalmazni kis és nagybetűt is!',
            'newpassword.symbols'   => 'Az új jelszónak kell tartalmazni speciális karaktert!',
            'newpassword.confirmed' => 'A két új jelszónak meg kell egyeznie'
        ]);

        if(Hash::check($req->password,Auth::user()->password)){
            $data = User::find(Auth::user()->user_id);
            $data->password = Hash::make($req->newpassword);
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

    public function UpdateProfileDetails_Backend(Request $req) {
        $req->validate([
            'username' => [
                'required',
                new UsernameUniqueRule()
            ],
            'realname' => [
                'required',
                new RealNameRule()
            ],
            "email" => [
                "required",
                "regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/",
                new UniqueEmailRule()
            ],
            "phonenumber" => [
                "required",
                "min:".self::$minPhoneNumberLength,
                "max:".self::$maxPhoneNumberLength,
                "regex:/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/",
                new phonenumberUniqueRule()
            ],
        ], [
            "username.required" => "Muszáj megadnia a felhasználónevét!",
            "username.unique" => "Ez a felhasználónév már foglalt!",

            "realname.required" => "Muszáj megadnia a polgári nevét!",

            "email.required" => "Muszáj megadnia az e-mail címét!",
            "email.regex" => "Nem egy e-mail címet adott meg!",

            "phonenumber.required" => "Muszáj megadnia a telefonszámát!",
            "phonenumber.regex" => "Érvényes telefonszámot adjon meg!",
            "phonenumber.min" => "A telefonszámnak legalább ".self::$minPhoneNumberLength." számjegy hosszúnak kell lennie!",
            "phonenumber.max" => "A telefonszám legfeljebb ".self::$maxPhoneNumberLength." számjegy hosszú lehet!",
            "phonenumber.unique" => "Ez a telefonszám már más által használva van!",
        ]);
        $data = User::find(Auth::user()->user_id);
        $data->username = $req->username;
        $nev = explode(' ', $req->realname, 2);
        $data->lastName = $nev[0];
        $data->firstName = $nev[1];
        $data->email = $req->email;
        $data->phonenumber = $req->phonenumber;
        $data->Save();

        return redirect("/profil");
    }

    public function SetNewPFP_Backend(Request $req){
        $data = User::find(Auth::user()->user_id);
        $data->profilePic = $req->pfp;
        $data->save();

        return redirect("/profil");
    }

    public function Logout_Backend() {
        Auth::logout();
        return redirect("/")->with('sv', 'Sikeres kijelentkezés!');
    }

    public function DeleteAccount_Backend(Request $request) {
        $user_id = Auth::user()->user_id;
        if ($request->deleteReviews) {
            Review::fromQuery("update reviews set active = 0 where user_id = ".$user_id);
        }

        $user = User::find($user_id);
        $user->active = false;
        $user->Save();

        Auth::logout();

        return redirect("/");
    }
    //endregion
}
