<?php

namespace App\DTO\Response\Hotel;

class HotelResponseDTO
{
    public int $id;
    public string $name;
    public string $location;
    public ?string $phone;
    public int $emptyRoom;
    public float $price;
    public ?string $description;
}
