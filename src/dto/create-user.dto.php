<?php

namespace App\Dto;

class UserDto
{
    public ?int $id = null;
    public string $username;
    public string $password;
    public string $email;
    public ?string $phone = null;
    public string $role;
    public ?int $promoId = null;
}
