<?php

namespace App\Rules;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Validation\ValidationRule;

class lol implements ValidationRule
{
/**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
    }
    private $ignoreId;

    public function __construct($ignoreId = null)
    {
        $this->ignoreId = $ignoreId;
    }

    public function passes($attribute, $value, $parameters, $validator)
    {
        // Add the names of the tables you want to check the email against
        $tables = ['doctors', 'users', 'admins'];

        foreach ($tables as $table) {
            $query = DB::table($table)->where('email', $value);

            if ($this->ignoreId) {
                $query->where('id', '!=', $this->ignoreId);
            }

            if ($query->exists()) {
                return false;
            }
        }

        return true;
    }

    public function message()
    {
        return 'The :attribute has already been taken.';
    }
}
