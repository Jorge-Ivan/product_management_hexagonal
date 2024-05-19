<?php

namespace App\Application\Validators\Product;

class CreateValidator
{
    public function validate(array $data): array
    {
        return validator($data, [
            'name' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'price' => 'required|integer',
            'categories.*' => 'number|exists:categories'
        ])->validate();
    }
}
