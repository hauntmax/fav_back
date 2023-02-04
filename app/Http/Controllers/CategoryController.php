<?php

namespace App\Http\Controllers;

use App\DTO\CategoryDto;
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
        $categories = $this->categoryService->getPaginatedCategories($request->validated());

        return CategoryResource::collection($categories);
    }

    public function byUser(CategoryIndexRequest $request): AnonymousResourceCollection
    {
        $userId = $request->user()?->getAuthIdentifier();
        $categories = $this->categoryService->getPaginatedCategories($request->validated(), $userId);

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
        $categoryDto = CategoryDto::fromRequest($request);

        $category = $this->categoryService->update($category, $categoryDto);

        return CategoryResource::make($category);
    }

    public function destroy(Category $category): JsonResponse
    {
        $category->delete();

        return response()->json(status: Response::HTTP_NO_CONTENT);
    }
}
