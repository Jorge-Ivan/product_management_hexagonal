<?php
namespace App\Application\UseCases\Product;

use App\Domain\Repositories\ProductRepositoryInterface;
use App\Application\Validators\Product\UpdateValidator;

class UpdateProduct
{
    private $productRepository;
    private $updateValidator;

    public function __construct(ProductRepositoryInterface $productRepository, UpdateValidator $updateValidator)
    {
        $this->productRepository = $productRepository;
        $this->updateValidator = $updateValidator;
    }

    public function execute(int $id, array $data): Bool
    {
        $product = $this->productRepository->findById($id);
        if (!$product) {
            return false;
        }
        $productData = $this->updateValidator->validate($data);
        return $this->productRepository->update($product, $productData);
    }
}
