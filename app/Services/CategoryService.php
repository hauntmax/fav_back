<?php

namespace App\Services;

use App\Common\CrudTrait;
use App\DTO\CategoryDto;
use App\DTO\IndexRequestDto;
use App\Models\Category;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

class CategoryService
{
    use CrudTrait;

    public function getBuilder(): Builder
    {
        return Category::query();
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

    public function update(Category $category, array $attributes): Category
    {
        $category->update($attributes);

        return $category;
    }

    public function getCategoriesByAuthor(int $userId, IndexRequestDto $indexRequestDto): LengthAwarePaginator
    {
        return Category::query()->where('user_id', $userId)
            ->paginate(perPage: $indexRequestDto->perPage, page: $indexRequestDto->page);
    }
}
