<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "Booking")]
class Booking
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $bookingId;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: "CASCADE")]
    private User $user;

    #[ORM\ManyToOne(targetEntity: Promo::class)]
    #[ORM\JoinColumn(nullable: true, onDelete: "SET NULL")]
    private ?Promo $promo = null;

    #[ORM\Column(type: 'datetime')]
    private \DateTime $bookingDate;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private float $totalPrice;

    #[ORM\Column(type: 'string', enumType: BookingStatus::class)]
    private BookingStatus $status;

    // Getters and setters...
}
