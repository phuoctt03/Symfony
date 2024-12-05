<?php

namespace App\DTO\Request\Flight;

use Symfony\Component\Validator\Constraints as Assert;

class CreateFlightDTO
{
    #[Assert\NotBlank]
    #[Assert\Length(max: 100)]
    public string $brand;

    #[Assert\NotBlank]
    #[Assert\PositiveOrZero]
    public int $emptySlot;

    #[Assert\NotBlank]
    public \DateTimeInterface $startTime;

    #[Assert\NotBlank]
    #[Assert\GreaterThan(propertyPath: 'startTime')]
    public \DateTimeInterface $endTime;

    #[Assert\NotBlank]
    #[Assert\Length(max: 100)]
    public string $startLocation;

    #[Assert\NotBlank]
    #[Assert\Length(max: 100)]
    public string $endLocation;

    #[Assert\NotBlank]
    #[Assert\PositiveOrZero]
    public float $price;
}
