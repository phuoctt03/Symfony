<?php

namespace App\Dto;

class BookingDto
{
    public ?int $id = null;
    public int $userId;
    public ?int $promoId = null;
    public \DateTimeInterface $bookingDate;
    public float $totalPrice;
    public string $status;
}
