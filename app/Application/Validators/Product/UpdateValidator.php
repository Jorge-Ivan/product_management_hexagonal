<?php

namespace App\Application\Validators\Product;

class UpdateValidator
{
    public function validate(array $data): array
    {
        return validator($data, [
            'name' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'price' => 'required|integer',
            'categories.*' => 'integer|exists:categories,id'
        ])->validate();
    }
}
