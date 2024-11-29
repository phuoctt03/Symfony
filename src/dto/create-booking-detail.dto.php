<?php

namespace App\Dto;

class BookingDetailDto
{
    public ?int $id = null;
    public int $bookingId;
    public ?int $flightId = null;
    public ?int $hotelId = null;
    public ?int $activityId = null;
    public int $quantity;
}
