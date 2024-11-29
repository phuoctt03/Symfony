<?php

namespace App\Dto;

class CartUpdateDto
{
    public ?int $flightId = null;
    public ?int $hotelId = null;
    public ?int $activityId = null;
    public ?int $quantity = null;
}
