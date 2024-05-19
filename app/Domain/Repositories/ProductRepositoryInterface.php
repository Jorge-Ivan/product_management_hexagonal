<?php
namespace App\Domain\Repositories;

use App\Domain\Entities\Product;

interface ProductRepositoryInterface
{
    public function create(array $data): Product;
    public function update(Product $product, array $data): bool;
    public function delete(Product $product): bool;
    public function findById(int $id): ?Product;
    public function findAll(): array;
    public function findByCategoryAndPrice(array $filters): array;
}
