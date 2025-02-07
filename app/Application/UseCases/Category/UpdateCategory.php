<?php
namespace App\Application\UseCases\Category;

use App\Domain\Repositories\CategoryRepositoryInterface;
use App\Application\Validators\Category\UpdateValidator;

class UpdateCategory
{
    private $categoryRepository;
    private $updateValidator;

    public function __construct(CategoryRepositoryInterface $categoryRepository, UpdateValidator $updateValidator)
    {
        $this->categoryRepository = $categoryRepository;
        $this->updateValidator = $updateValidator;
    }

    public function execute(int $id, array $data): bool
    {
        $category = $this->categoryRepository->findById($id);
        if (!$category) {
            return false;
        }
        $categoryData = $this->updateValidator->validate($data);
        return $this->categoryRepository->update($category, $categoryData);
    }
}
