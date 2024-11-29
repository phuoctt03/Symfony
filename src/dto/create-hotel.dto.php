<?php

namespace App\Dto;

class HotelDto
{
    public ?int $id = null;
    public string $name;
    public string $address;
    public ?string $phone = null;
    public float $price;
}
