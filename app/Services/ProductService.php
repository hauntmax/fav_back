<?php

namespace App\Services;

use App\Common\CrudTrait;
use App\DTO\IndexRequestDto;
use App\DTO\ProductDto;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

class ProductService
{
    use CrudTrait;

    public function getBuilder(): Builder
    {
        return Product::query();
    }

    public function create(ProductDto $dto): Product
    {
        /** @var Product $product */
        $product = Product::create([
            'user_id' => $dto->userId,
            'name' => $dto->name,
            'description' => $dto->description,
            'price' => $dto->price,
        ]);

        if (!is_null($dto->categoryIds)) {
            $product->categories()->attach($dto->categoryIds);
        }

        return $product;
    }

    public function update(Product $product, array $attributes): Product
    {
        $product->update(Arr::only($attributes, ['name', 'description', 'price']));

        if (!is_null($categoryIds = Arr::get($attributes, 'category_ids'))) {
            $product->categories()->sync($categoryIds);
        }

        return $product;
    }

    public function getProductsByCategory(Category $category, IndexRequestDto $indexRequestDto): LengthAwarePaginator
    {
        return $category->products()
            ->paginate(perPage: $indexRequestDto->perPage, page: $indexRequestDto->page);
    }

    public function getProductsByUser(int $userId, IndexRequestDto $indexRequestDto): LengthAwarePaginator
    {
        return Product::query()->where('user_id', $userId)
            ->paginate(perPage: $indexRequestDto->perPage, page: $indexRequestDto->page);
    }
}
