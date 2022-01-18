<?php

namespace App\Services;

use App\Repositories\{
    CategoryRepository,
    ProductRepository
};


class ProductService
{

    protected $repository, $categoryRepository;

    public function __construct(
        ProductRepository $productRepository,
        CategoryRepository $categoryRepository
    ) {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function getProductsByCategory(string $category)
    {
        $category = $this->categoryRepository->getCategoryByUuid($category);

        return $this->productRepository->getProductCategory($category->id);
    }

    public function createNewProduct(array $data)
    {
        $category = $this->categoryRepository->getCategoryByUuid($data['category']);

        return $this->productRepository->createNewProduct($category->id, $data);
    }

    public function getProductByCategory(string $category, string $uuid)
    {
        $category = $this->categoryRepository->getCategoryByUuid($category);

        return $this->productRepository->getProductByCategory($category->id, $uuid);
    }

    public function updateProduct(string $uuid, array $data)
    {
        $category = $this->categoryRepository->getCategoryByUuid($data['category']);

        return $this->productRepository->updateProductByUuid($category->id, $uuid, $data);
    }

    public function deleteProduct(string $uuid)
    {
        return $this->productRepository->deleteProductByUuid($uuid);
    }
}
