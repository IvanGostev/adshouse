<?php

namespace App\Rules;

use App\Models\User;
use Closure;

use Illuminate\Contracts\Validation\ValidationRule;

class UniqueEmailForRoleRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    protected string $role;

    public function __construct($role)
    {
        $this->role = $role;
    }

    public function validate(string $attribute, mixed $email, Closure $fail): void
    {
        $user = User::where('role', $this->role)->where('email', $email)->first();
        if ($user) {
            $fail('The email has already been taken');
        }


    }
}
