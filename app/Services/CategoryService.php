<?php

namespace App\Services;

use App\Repositories\CategoryRepository;

class CategoryService
{

    protected $repository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->repository = $categoryRepository;
    }

    public function getCategories()
    {
        return $this->repository->getAllCategories();
    }

    public function createNewCategory(array $data)
    {
        return $this->repository->createNewCategory($data);
    }

    public function getCategory(string $uuid)
    {
        return $this->repository->getCategoryByUuid($uuid);
    }

    public function deleteCategory(string $uuid)
    {
        return $this->repository->deleteCategoryByUuid($uuid);
    }

    public function updateCategory(string $uuid, array $data)
    {
        return $this->repository->updateCategoryByUuid($uuid, $data);
    }
}
