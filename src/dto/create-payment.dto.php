<?php

namespace App\Dto;

class PaymentDto
{
    public ?int $id = null;
    public int $userId;
    public int $bookingId;
    public \DateTimeInterface $paymentDate;
    public string $paymentMethod;
    public string $status;
}
