<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Support\Facades\Cache;

class CategoryRepository
{
    protected $entity;

    public function __construct(Category $category)
    {
        $this->entity = $category;
    }

    public function getAllCategories()
    {

        return Cache::rememberForever('categories', function () {
            return $this->entity->with('products')->get();
        });
    }

    public function createNewCategory(array $data)
    {
        Cache::forget('categories');

        return $this->entity->create($data);
    }

    public function getCategoryByUuid(string $uuid)
    {
        return $this->entity->where('uuid', $uuid)->firstOrFail();
    }

    public function deleteCategoryByUuid(string $uuid)
    {
        $category = $this->getCategoryByUuid($uuid);

        Cache::forget('categories');

        return $category->delete();
    }

    public function updateCategoryByUuid(string $uuid, array $data)
    {
        $category = $this->getCategoryByUuid($uuid);

        Cache::forget('categories');

        return $category->update($data);
    }
}
