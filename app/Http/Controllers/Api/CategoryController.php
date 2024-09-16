<?php

namespace App\Http\Controllers\Api;

use App\DTO\CategoryDto;
use App\DTO\IndexRequestDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryStoreRequest;
use App\Http\Requests\Category\CategoryIndexRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    public function __construct(
        private CategoryService $categoryService
    )
    {
    }

    public function index(CategoryIndexRequest $request): AnonymousResourceCollection
    {
        $indexRequestDto = IndexRequestDto::fromRequest($request);
        $categories = $this->categoryService->getPaginated($indexRequestDto);

        return CategoryResource::collection($categories);
    }

    public function byAuthor(CategoryIndexRequest $request): AnonymousResourceCollection
    {
        $indexRequestDto = IndexRequestDto::fromRequest($request);
        $categories = $this->categoryService->getCategoriesByAuthor($request->user()?->getAuthIdentifier(), $indexRequestDto);

        return CategoryResource::collection($categories);
    }

    public function show(Category $category): JsonResource
    {
        return CategoryResource::make($category);
    }

    public function store(CategoryStoreRequest $request): JsonResource
    {
        $categoryDto = CategoryDto::fromRequest($request);
        $category = $this->categoryService->create($categoryDto);

        return CategoryResource::make($category);
    }

    public function update(Category $category, CategoryStoreRequest $request): JsonResource
    {
        $category = $this->categoryService->update($category, $request->validated());

        return CategoryResource::make($category);
    }

    public function destroy(Category $category): JsonResponse
    {
        $this->categoryService->delete($category);

        return response()->json(status: Response::HTTP_NO_CONTENT);
    }
}
