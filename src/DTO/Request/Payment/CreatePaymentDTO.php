<?php

namespace App\DTO\Request\Payment;

use Symfony\Component\Validator\Constraints as Assert;

class CreatePaymentDTO
{
    #[Assert\NotBlank]
    public int $userId;

    #[Assert\NotBlank]
    public int $bookingId;

    #[Assert\NotBlank]
    #[Assert\Choice(choices: ['Credit Card', 'Debit Card', 'PayPal', 'Cash'])]
    public string $paymentMethod;
}
