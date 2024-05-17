<?php

namespace App\Application\Validators\User;

class UserCreateValidator
{
    public function validate(array $data): array
    {
        return validator($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:8',
        ])->validate();
    }
}
