<?php

namespace App\DTO\Response\Promo;

class PromoResponseDTO
{
    public int $id;
    public string $name;
    public ?string $description;
    public float $discount;
    public \DateTimeInterface $createdDate;
    public \DateTimeInterface $expiredDate;
    public int $amount;
    public string $conditions;
}
