<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "Payment")]
class Payment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $paymentId;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: "CASCADE")]
    private User $user;

    #[ORM\ManyToOne(targetEntity: Booking::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: "CASCADE")]
    private Booking $booking;

    #[ORM\Column(type: 'string', enumType: PaymentMethod::class)]
    private PaymentMethod $paymentMethod;

    #[ORM\Column(type: 'datetime')]
    private \DateTime $paymentDate;

    // Getters and setters...
}
