<?php

namespace App\DTO\Response\Payment;

class PaymentResponseDTO
{
    public int $id;
    public int $userId;
    public int $bookingId;
    public string $paymentMethod;
    public \DateTimeInterface $paymentDate;
}
