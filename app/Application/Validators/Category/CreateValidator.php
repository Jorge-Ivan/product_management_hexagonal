<?php

namespace App\Application\Validators\Category;

class CreateValidator
{
    public function validate(array $data): array
    {
        return validator($data, [
            'name' => 'required|string|max:255',
        ])->validate();
    }
}
