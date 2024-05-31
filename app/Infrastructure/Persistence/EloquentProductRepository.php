<?php
namespace App\Infrastructure\Persistence;

use App\Domain\Entities\Product;
use App\Domain\Repositories\ProductRepositoryInterface;
use DB;

class EloquentProductRepository implements ProductRepositoryInterface
{
    public function create(array $data): Product
    {
        DB::beginTransaction();
        try {
            $product = new Product();
            $product->fill($data);
            $product->save();
            if(isset($data['categories']) && !empty($data['categories']))
                $product->categories()->sync($data['categories']);
            DB::commit();

            return $product;
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

    public function update(Product $product, array $data): bool
    {
        DB::beginTransaction();
        try {
            $product->fill($data);
            $product->save();
            if(isset($data['categories']) && !empty($data['categories']))
                $product->categories()->sync($data['categories']);
            DB::commit();

            return true;
        } catch (\Throwable $th) {
            DB::rollback();
            return false;
        }
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
        $query = Product::select('id', 'price', 'name')->where('stock', '>', 0);
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
