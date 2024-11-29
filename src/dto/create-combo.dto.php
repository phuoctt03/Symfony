<?php

namespace App\Dto;

class ComboDto
{
    public ?int $id = null;
    public string $name;
    public ?string $description = null;
    public float $price;
    public ?int $promoId = null;
}
