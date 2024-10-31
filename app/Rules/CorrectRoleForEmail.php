<?php

namespace App\Rules;

use App\Models\User;
use Closure;

use Illuminate\Contracts\Validation\ValidationRule;

class CorrectRoleForEmail implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    protected string $email;

    public function __construct($email)
    {
        $this->email = $email;
    }

    public function validate(string $attribute, mixed $role, Closure $fail): void
    {
        $user = User::where('email', $this->email)->where('role', $role)->first();
        if (!$user) {
            $fail('The account cannot be found');
        }
    }
}
