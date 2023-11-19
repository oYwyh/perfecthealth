<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UniqueEmailAcrossTables implements ValidationRule
{
    private $userId;
    private $userRole;

    public function __construct($userId)
    {
        $this->userId = $userId;
        $this->userRole = $this->getRoleFromGuard();
    }

    private function getRoleFromGuard()
    {
        $guard = Auth::getDefaultDriver();

        // Map the guard name to the corresponding table name
        $guardToRoleMap = [
            'web' => 'users',
            'admin' => 'admins',
            'doctor' => 'doctors',
            'receptionist' => 'reciptionists',
        ];

        return $guardToRoleMap[$guard] ?? null;
    }

    public function validate(string $attribute, $value, Closure $fail): void
    {
        $tables = ['admins', 'users', 'doctors', 'receptionists'];

        foreach ($tables as $table) {
            $query = DB::table($table)->where('email', $value);

            // If the table corresponds to the user's role, ignore their id
            if ($table === $this->userRole) {
                $query->where('id', '!=', $this->userId);
            }

            $exists = $query->exists();

            if ($exists) {
                $fail("The :attribute has already been taken.");
            }
        }
    }
}
