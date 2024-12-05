<?php

namespace App\DTO\Request\BookingDetail;

use Symfony\Component\Validator\Constraints as Assert;

class CreateBookingDetailDTO
{
    #[Assert\NotBlank]
    public int $bookingId;

    public ?int $flightId = null;
    public ?int $hotelId = null;
    public ?int $activityId = null;
    public ?int $comboId = null;

    #[Assert\NotBlank]
    #[Assert\Positive]
    public int $quantity;

    #[Assert\NotBlank]
    public \DateTimeInterface $checkInDate;

    #[Assert\GreaterThan(propertyPath: 'checkInDate')]
    public \DateTimeInterface $checkOutDate;
}
