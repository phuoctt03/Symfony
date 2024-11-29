<?php

namespace App\Dto;

class PromoDto
{
    public ?int $id = null;
    public string $name;
    public ?string $description = null;
    public float $discount;
    public \DateTimeInterface $expiredDate;
    public int $amount;
    public ?string $conditions = null;
}
