<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UniqueEmailAcrossTables implements Rule
{
    private $ignoreId;

    public function __construct($ignoreId = null)
    {
        $this->ignoreId = $ignoreId;
    }

    public function passes($attribute, $value)
    {
        // Add the names of the tables you want to check the email against
        $tables = ['doctors', 'users', 'admins','receptionists'];

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
