<?php

namespace App\Dto;

class BookingDetailUpdateDto
{
    public ?int $flightId = null;
    public ?int $hotelId = null;
    public ?int $activityId = null;
    public ?int $quantity = null;
}
