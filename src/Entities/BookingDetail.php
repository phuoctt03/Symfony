<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "BookingDetail")]
class BookingDetail
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $bookingDetailId;

    #[ORM\ManyToOne(targetEntity: Booking::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: "CASCADE")]
    private Booking $booking;

    #[ORM\ManyToOne(targetEntity: Flight::class)]
    #[ORM\JoinColumn(nullable: true, onDelete: "CASCADE")]
    private ?Flight $flight = null;

    #[ORM\ManyToOne(targetEntity: Hotel::class)]
    #[ORM\JoinColumn(nullable: true, onDelete: "CASCADE")]
    private ?Hotel $hotel = null;

    #[ORM\ManyToOne(targetEntity: Activity::class)]
    #[ORM\JoinColumn(nullable: true, onDelete: "CASCADE")]
    private ?Activity $activity = null;

    #[ORM\ManyToOne(targetEntity: Combo::class)]
    #[ORM\JoinColumn(nullable: true, onDelete: "CASCADE")]
    private ?Combo $combo = null;

    #[ORM\Column(type: 'integer')]
    private int $quantity;

    #[ORM\Column(type: 'datetime')]
    private \DateTime $checkInDate;

    #[ORM\Column(type: 'datetime')]
    private \DateTime $checkOutDate;

    // Getters and setters...
}
