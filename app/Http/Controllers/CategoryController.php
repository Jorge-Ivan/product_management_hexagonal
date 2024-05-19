<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application\UseCases\Category\CreateCategory;
use App\Application\UseCases\Category\UpdateCategory;

class CategoryController extends Controller
{
    private $createCategory;
    private $updateCategory;

    public function __construct(CreateCategory $createCategory, UpdateCategory $updateCategory)
    {
        $this->createCategory = $createCategory;
        $this->updateCategory = $updateCategory;
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $result = $this->createCategory->execute($data);
        return response()->json($result, 201);
    }

    public function update(int $id, Request $request)
    {
        $data = $request->all();
        $result = $this->updateCategory->execute($id, $data);
        return response()->json($result, 201);
    }
}
