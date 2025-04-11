<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class phonenumberUniqueRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $user = Auth::user();
        if (($user == null || $value != $user->phonenumber) && User::where("phonenumber", $value)->where("active",1)->count() > 0) {
            $fail("Ez a telefonszám már foglalt!");
        }
    }
}
