<?php

namespace App\Http\Controllers\Api;

use App\DTO\IndexRequestDto;
use App\DTO\ProductDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\AttachCategoriesRequest;
use App\Http\Requests\Product\ProductIndexRequest;
use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function __construct(
        private ProductService $productService
    )
    {
    }

    public function index(ProductIndexRequest $request): AnonymousResourceCollection
    {
        $indexRequestDto = IndexRequestDto::fromRequest($request);
        $products = $this->productService->getPaginated($indexRequestDto);

        return ProductResource::collection($products);
    }

    public function byAuthor(ProductIndexRequest $request): AnonymousResourceCollection
    {
        $indexRequestDto = IndexRequestDto::fromRequest($request);
        $products = $this->productService->getProductsByUser($request->user()?->getAuthIdentifier(), $indexRequestDto);

        return ProductResource::collection($products);
    }

    public function byCategory(Category $category, ProductIndexRequest $request): AnonymousResourceCollection
    {
        $indexRequestDto = IndexRequestDto::fromRequest($request);
        $products = $this->productService->getProductsByCategory($category, $indexRequestDto);

        return ProductResource::collection($products);
    }

    public function show(Product $product): JsonResource
    {
        return ProductResource::make($product);
    }

    public function store(ProductStoreRequest $request): JsonResource
    {
        $productDto = ProductDto::fromRequest($request);
        $product = $this->productService->create($productDto);

        return ProductResource::make($product);
    }

    public function update(Product $product, ProductUpdateRequest $request): JsonResource
    {
        $product = $this->productService->update($product, $request->validated());

        return ProductResource::make($product);
    }

    public function destroy(Product $product): JsonResponse
    {
        $this->productService->delete($product);

        return response()->json(status: Response::HTTP_NO_CONTENT);
    }

    public function attach(Product $product, AttachCategoriesRequest $request): JsonResponse
    {
        $categoryIds = $request->get('category_ids');

        return response()->json([
            'data' => $product->categories()->syncWithoutDetaching($categoryIds),
        ]);
    }
}
