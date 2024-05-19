<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application\UseCases\Category\CreateCategory;
use App\Application\UseCases\Category\UpdateCategory;
use App\Application\UseCases\Category\DeleteCategory;

class CategoryController extends Controller
{
    private $createCategory;
    private $updateCategory;
    private $deleteCategory;

    public function __construct(CreateCategory $createCategory, UpdateCategory $updateCategory, DeleteCategory $deleteCategory)
    {
        $this->createCategory = $createCategory;
        $this->updateCategory = $updateCategory;
        $this->deleteCategory = $deleteCategory;
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
        $success = $this->updateCategory->execute($id, $data);

        if ($success) {
            return response()->json(['message' => 'Category update successfully.'], 200);
        }

        return response()->json(['message' => 'Category not found.'], 404);
    }

    public function destroy($id)
    {
        $success = $this->deleteCategory->execute($id);

        if ($success) {
            return response()->json(['message' => 'Category deleted successfully.'], 200);
        }

        return response()->json(['message' => 'Category not found.'], 404);
    }
}
