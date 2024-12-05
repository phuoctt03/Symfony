<?php

namespace App\DTO\Request\User;

use Symfony\Component\Validator\Constraints as Assert;

class CreateUserDTO
{
    #[Assert\NotBlank]
    #[Assert\Length(min: 3, max: 20)]
    public string $username;

    #[Assert\NotBlank]
    #[Assert\Length(min: 8)]
    public string $password;

    #[Assert\NotBlank]
    #[Assert\Email]
    public string $email;

    #[Assert\Length(max: 15)]
    public ?string $phone = null;

    public ?string $address = null;

    #[Assert\Choice(choices: ['Admin', 'User', 'Silver', 'Gold'])]
    public string $role;
}
