<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class ProductRepository
{
    protected $entity;

    public function __construct(Product $product)
    {
        $this->entity = $product;
    }

    public function getProductCategory(int $categoryId)
    {
        return $this->entity
            ->where('category_id', $categoryId)
            ->get();
    }

    public function createNewProduct(int $categoryId, array $data)
    {
        $data['category_id'] = $categoryId;

        Cache::forget('categories');

        return $this->entity->create($data);
    }

    public function getProductByCategory(int $categoryId, string $uuid)
    {
        return $this->entity
            ->where('category_id', $categoryId)
            ->where('uuid', $uuid)
            ->firstOrFail();
    }

    public function getProductByUuid(string $uuid)
    {
        return $this->entity
            ->where('uuid', $uuid)
            ->firstOrFail();
    }

    public function updateProductByUuid(int $categoryId, string $uuid, array $data)
    {
        $product = $this->getProductByUuid($uuid);

        $data['category_id'] = $categoryId;

        Cache::forget('categories');

        return $product->update($data);
    }

    public function deleteProductByUuid(string $uuid)
    {
        $product = $this->getProductByUuid($uuid);

        Cache::forget('categories');

        return $product->delete();
    }
}
