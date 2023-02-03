<?php

namespace App\Http\Controllers;

use App\DTO\UserDto;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Arr;

class AuthController extends Controller
{
    public function __construct(
        private AuthService $authService
    )
    {
    }

    public function me(Request $request): JsonResource
    {
        /** @var User $user */
        $user = $request->user('api');

        if (is_null($user)) {
            abort(Response::HTTP_UNAUTHORIZED);
        }

        return UserResource::make($user);
    }

    public function register(RegisterRequest $request): JsonResource
    {
        $userDto = UserDto::fromRequest($request);
        $user = $this->authService->register($userDto);

        return UserResource::make($user);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $userDto = UserDto::fromRequest($request);
        $loginData = $this->authService->login($userDto);

        return response()->json($loginData, Arr::get($loginData, 'status', Response::HTTP_OK));
    }

    public function logout(): JsonResponse
    {
        auth()->logout();

        return response()->json(['message' => 'User logout']);
    }
}
