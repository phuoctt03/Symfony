<?php

namespace App\DTO\Response\User;

class UserResponseDTO
{
    public int $id;
    public string $username;
    public string $email;
    public ?string $phone;
    public ?string $address;
    public string $role;
}
