<?php

namespace App\Dto;

class UserUpdateDto
{
    public ?string $username = null;
    public ?string $password = null;
    public ?string $email = null;
    public ?string $phone = null;
    public ?string $role = null;
    public ?int $promoId = null;
}
