<?php

namespace App\DTO\Response\ComboDetail;

class ComboDetailResponseDTO
{
    public int $id;
    public int $comboId;
    public ?int $flightId;
    public ?int $hotelId;
    public ?int $activityId;
}
