<?php

namespace App\Services;

use App\DTO\UserDto;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthService
{
    public function register(UserDto $dto): User
    {
        /** @var User $user */
        $user = User::create([
            'name' => $dto->name,
            'email' => $dto->email,
            'password' => Hash::make($dto->password),
        ]);

        return $user;
    }

    public function login(UserDto $dto): array
    {
        $token = auth()->attempt([
            'email' => $dto->email,
            'password' => $dto->password
        ]);

        if (!$token) {
            return [
                'error' => 'Failed auth',
                'status' => Response::HTTP_NOT_FOUND,
            ];
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the token array structure.
     */
    protected function respondWithToken($token): array
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'status' => Response::HTTP_OK,
        ];
    }
}
