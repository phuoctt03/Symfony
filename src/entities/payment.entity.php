<?php

namespace App\Entity;

use App\Repository\PaymentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaymentRepository::class)]
class Payment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private User $user;

    #[ORM\ManyToOne(targetEntity: Booking::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Booking $booking;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $paymentDate;

    #[ORM\Column(type: 'string', enumType: PaymentMethod::class)]
    private PaymentMethod $paymentMethod;

    #[ORM\Column(type: 'string', enumType: PaymentStatus::class)]
    private PaymentStatus $status;

    // Getters and setters...
}
