<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CarResourceCollection;
use App\Services\Cars\CarListService;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function __construct(
        private readonly CarListService $carService
    ) {
    }

    public function index(Request $request): CarResourceCollection
    {
        return CarResourceCollection::make($this->carService->getAll($request->get('filters') ?? []));
    }
}
