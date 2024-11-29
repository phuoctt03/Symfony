<?php

namespace App\Dto;

class CartDto
{
    public ?int $id = null;
    public int $userId;
    public ?int $flightId = null;
    public ?int $hotelId = null;
    public ?int $activityId = null;
    public int $quantity;
    public \DateTimeInterface $createdDate;
}
