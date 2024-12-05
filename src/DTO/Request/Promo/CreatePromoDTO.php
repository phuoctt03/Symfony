<?php

namespace App\DTO\Request\Promo;

use Symfony\Component\Validator\Constraints as Assert;

class CreatePromoDTO
{
    #[Assert\NotBlank]
    #[Assert\Length(max: 100)]
    public string $name;

    public ?string $description = null;

    #[Assert\NotBlank]
    #[Assert\Range(min: 0, max: 100)]
    public float $discount;

    #[Assert\NotBlank]
    public \DateTimeInterface $expiredDate;

    #[Assert\PositiveOrZero]
    public int $amount;

    #[Assert\Choice(choices: ['Public', 'Silver', 'Gold'])]
    public string $conditions;
}
