<?php
namespace App\Infrastructure\Persistence;

use App\Domain\Entities\Product;
use App\Domain\Repositories\ProductRepositoryInterface;

class EloquentProductRepository implements ProductRepositoryInterface
{
    public function create(array $data): Product
    {
        return Product::create($data);
    }

    public function update(Product $product, array $data): bool
    {
        return $product->update($data);
    }

    public function delete(Product $product): bool
    {
        $product->categories()->detach();
        return $product->delete();
    }

    public function findById(int $id): ?Product
    {
        return Product::find($id);
    }

    public function findAll(): array
    {
        return Product::all()->toArray();
    }

    public function findByCategoryAndPrice(array $filters): array
    {
        $query = Product::query();
        if (isset($filters['category_id'])) {
            $query->whereHas('categories', function($q) use ($filters) {
                $q->where('category_id', $filters['category_id']);
            });
        }
        if (isset($filters['price'])) {
            $query->where('price', '<=', $filters['price']);
        }
        return $query->get()->toArray();
    }
}
