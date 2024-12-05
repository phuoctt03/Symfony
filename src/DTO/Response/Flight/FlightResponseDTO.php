<?php

namespace App\DTO\Response\Flight;

class FlightResponseDTO
{
    public int $id;
    public string $brand;
    public int $emptySlot;
    public \DateTimeInterface $startTime;
    public \DateTimeInterface $endTime;
    public string $startLocation;
    public string $endLocation;
    public float $price;
}
