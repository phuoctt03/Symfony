<?php

namespace App\DTO\Request\Hotel;

use Symfony\Component\Validator\Constraints as Assert;

class CreateHotelDTO
{
    #[Assert\NotBlank]
    #[Assert\Length(max: 100)]
    public string $name;

    #[Assert\NotBlank]
    #[Assert\Length(max: 100)]
    public string $location;

    #[Assert\Length(max: 15)]
    public ?string $phone = null;

    #[Assert\NotBlank]
    #[Assert\PositiveOrZero]
    public int $emptyRoom;

    #[Assert\NotBlank]
    #[Assert\PositiveOrZero]
    public float $price;

    public ?string $description = null;
}
