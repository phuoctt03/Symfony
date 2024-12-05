<?php

namespace App\DTO\Response\Booking;

class BookingResponseDTO
{
    public int $id;
    public int $userId;
    public ?int $promoId;
    public \DateTimeInterface $bookingDate;
    public float $totalPrice;
    public string $status;
}
