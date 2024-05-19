<?php
namespace App\Application\UseCases\Category;

use App\Domain\Entities\Category;
use App\Domain\Repositories\CategoryRepositoryInterface;
use App\Application\Validators\Category\CreateValidator;

class CreateCategory
{
    private $categoryRepository;
    private $createValidator;

    public function __construct(CategoryRepositoryInterface $categoryRepository, CreateValidator $createValidator)
    {
        $this->categoryRepository = $categoryRepository;
        $this->createValidator = $createValidator;
    }

    public function execute(array $data): Category
    {
        $categoryData = $this->createValidator->validate($data);
        return $this->categoryRepository->create($categoryData);
    }
}
