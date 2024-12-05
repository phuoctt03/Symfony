<?php

namespace App\DTO\Request\Activity;

use Symfony\Component\Validator\Constraints as Assert;

class CreateActivityDTO
{
    #[Assert\NotBlank]
    #[Assert\Length(max: 100)]
    public string $name;

    #[Assert\NotBlank]
    #[Assert\PositiveOrZero]
    public int $emptySlot;

    #[Assert\NotBlank]
    #[Assert\Length(max: 100)]
    public string $location;

    public ?string $description = null;

    #[Assert\NotBlank]
    #[Assert\PositiveOrZero]
    public float $price;
}
