<?php

namespace App\Application\UseCases\Product;

use App\Domain\Repositories\ProductRepositoryInterface;

class DeleteProduct
{
    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function execute(int $id): bool
    {
        $Product = $this->productRepository->findById($id);

        if (!$Product) {
            return false;
        }

        return $this->productRepository->delete($Product);
    }
}
