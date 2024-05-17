<?php
namespace App\Infrastructure\Persistence;

use App\Domain\Entities\Category;
use App\Domain\Repositories\CategoryRepositoryInterface;

class EloquentCategoryRepository implements CategoryRepositoryInterface
{
    public function create(array $data): Category
    {
        return Category::create($data);
    }

    public function update(Category $category, array $data): bool
    {
        return $category->update($data);
    }

    public function findById(int $id): ?Category
    {
        return Category::find($id);
    }

    public function findAll(): array
    {
        return Category::all()->toArray();
    }
}
