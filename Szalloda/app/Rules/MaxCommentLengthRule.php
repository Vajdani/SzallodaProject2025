<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Http\Controllers\ReviewController;

class MaxCommentLengthRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $max = ReviewController::$maxCommentLength;
        if (mb_strlen(str_replace(PHP_EOL, '', $value)) > $max) {
            $fail("Legfeljebb ".$max." karakter hosszú értékelést írhat!");
        }
    }
}
