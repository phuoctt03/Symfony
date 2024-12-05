<?php

namespace App\DTO\Response\Activity;

class ActivityResponseDTO
{
    public int $id;
    public string $name;
    public int $emptySlot;
    public string $location;
    public ?string $description;
    public float $price;
}
