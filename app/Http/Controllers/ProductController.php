<?php

namespace App\Http\Controllers;

use App\DTO\IndexRequestDto;
use App\DTO\ProductDto;
use App\Http\Requests\Product\ProductIndexRequest;
use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Http\Resources\ProductResource;
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

        $products = $this->productService->getPaginated($indexRequestDto, $request->user()?->getAuthIdentifier());

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
        $productDto = ProductDto::fromRequest($request);

        $product = $this->productService->update($product, $productDto);

        return ProductResource::make($product);
    }

    public function destroy(Product $product): JsonResponse
    {
        $product->delete();

        return response()->json(status: Response::HTTP_NO_CONTENT);
    }
}
