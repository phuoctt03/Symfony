<?php

namespace App\DTO\Request\Booking;

use Symfony\Component\Validator\Constraints as Assert;

class CreateBookingDTO
{
    #[Assert\NotBlank]
    public int $userId;

    public ?int $promoId = null;

    #[Assert\NotBlank]
    #[Assert\PositiveOrZero]
    public float $totalPrice;

    #[Assert\Choice(choices: ['Pending', 'Confirmed', 'Cancelled'])]
    public string $status;
}
