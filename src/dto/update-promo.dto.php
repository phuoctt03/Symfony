<?php

namespace App\Dto;

class PromoUpdateDto
{
    public ?string $name = null;
    public ?string $description = null;
    public ?float $discount = null;
    public ?\DateTimeInterface $expiredDate = null;
    public ?int $amount = null;
    public ?string $conditions = null;
}
