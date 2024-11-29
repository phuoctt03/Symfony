<?php

namespace App\Dto;

class FlightUpdateDto
{
    public ?string $branch = null;
    public ?\DateTimeInterface $startTime = null;
    public ?\DateTimeInterface $endTime = null;
    public ?string $startLocation = null;
    public ?string $endLocation = null;
    public ?float $price = null;
}
