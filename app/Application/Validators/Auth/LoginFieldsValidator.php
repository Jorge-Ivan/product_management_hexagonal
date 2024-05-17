<?php

namespace App\Application\Validators\Auth;

class LoginFieldsValidator
{
    public function validate(array $data): array
    {
        return validator($data, [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ])->validate();
    }
}
