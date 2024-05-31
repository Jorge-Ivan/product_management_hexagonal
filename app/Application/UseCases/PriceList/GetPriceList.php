<?php
namespace App\Application\UseCases\PriceList;

use App\Domain\Repositories\ProductRepositoryInterface;

class GetPriceList
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function execute(array $filters)
    {
        return $this->productRepository->findByCategoryAndPrice($filters);
    }
}
