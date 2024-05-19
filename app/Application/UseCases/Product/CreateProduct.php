<?php

namespace App\Application\UseCases\Product;

use App\Domain\Entities\Product;
use App\Domain\Repositories\ProductRepositoryInterface;
use App\Application\Validators\Product\CreateValidator;

class CreateProduct
{
    private $productRepository;
    private $createValidator;

    public function __construct(ProductRepositoryInterface $productRepository, CreateValidator $createValidator)
    {
        $this->productRepository = $productRepository;
        $this->createValidator = $createValidator;
    }

    public function execute(array $data): Product
    {
        $productData = $this->createValidator->validate($data);
        return $this->productRepository->create($productData);
    }
}
