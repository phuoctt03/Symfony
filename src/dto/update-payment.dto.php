<?php

namespace App\Dto;

class PaymentUpdateDto
{
    public ?\DateTimeInterface $paymentDate = null;
    public ?string $paymentMethod = null;
    public ?string $status = null;
}
