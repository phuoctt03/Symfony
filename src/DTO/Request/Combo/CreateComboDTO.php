<?php

namespace App\DTO\Request\Combo;

use Symfony\Component\Validator\Constraints as Assert;

class CreateComboDTO
{
    #[Assert\NotBlank]
    #[Assert\Length(max: 100)]
    public string $name;

    public ?string $description = null;

    #[Assert\NotBlank]
    #[Assert\PositiveOrZero]
    public float $price;
}
