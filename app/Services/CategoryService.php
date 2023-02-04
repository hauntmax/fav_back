<?php

namespace App\Services;

use App\DTO\CategoryDto;
use App\Models\Category;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;

class CategoryService
{
    public function getPaginatedCategories(array $paginateData = [], int $userId = null): LengthAwarePaginator
    {
        $categoryBuilder = Category::query();

        if (!is_null($userId)) {
            $categoryBuilder->where('user_id', $userId);
        }

        if (!empty($paginateData)) {
            $page = Arr::get($paginateData, 'page');
            $perPage = Arr::get($paginateData, 'per-page');

            return $categoryBuilder->paginate(perPage: $perPage, page: $page);
        }

        return $categoryBuilder->paginate();
    }

    public function create(CategoryDto $dto): Category
    {
        /** @var Category $category */
        $category = Category::create([
            'user_id' => $dto->userId,
            'name' => $dto->name,
            'description' => $dto->description,
        ]);

        return $category;
    }

    public function update(Category $category, CategoryDto $dto): Category
    {
        $category->update([
            'name' => $dto->name,
            'description' => $dto->description,
        ]);

        return $category;
    }
}
