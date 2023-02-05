<?php

namespace App\Services;

use App\Common\CrudTrait;
use App\DTO\ProductDto;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;

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

        return $product;
    }

    public function update(Product $product, ProductDto $dto): Product
    {
        $product->update([
            'name' => $dto->name,
            'description' => $dto->description,
            'price' => $dto->price,
        ]);

        return $product;
    }
}
