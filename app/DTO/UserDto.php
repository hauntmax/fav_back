<?php

namespace App\DTO;

use Illuminate\Http\Request;
use Spatie\DataTransferObject\DataTransferObject;

class UserDto extends DataTransferObject
{
    public ?string $name;
    public string $email;
    public string $password;

    public static function fromRequest(Request $request): UserDto
    {
        return new self([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ]);
    }
}
