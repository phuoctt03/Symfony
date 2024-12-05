<?php

namespace App\DTO\Response\BookingDetail;

class BookingDetailResponseDTO
{
    public int $id;
    public int $bookingId;
    public ?int $flightId;
    public ?int $hotelId;
    public ?int $activityId;
    public ?int $comboId;
    public int $quantity;
    public \DateTimeInterface $checkInDate;
    public \DateTimeInterface $checkOutDate;
}
