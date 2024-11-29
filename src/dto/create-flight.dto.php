<?php

namespace App\Dto;

class FlightDto
{
    public ?int $id = null;
    public string $branch;
    public \DateTimeInterface $startTime;
    public \DateTimeInterface $endTime;
    public string $startLocation;
    public string $endLocation;
    public float $price;
}
