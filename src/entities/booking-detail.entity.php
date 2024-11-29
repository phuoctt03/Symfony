<?php

namespace App\Entity;

use App\Repository\BookingDetailRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookingDetailRepository::class)]
class BookingDetail
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Booking::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Booking $booking;

    #[ORM\ManyToOne(targetEntity: Flight::class)]
    private ?Flight $flight = null;

    #[ORM\ManyToOne(targetEntity: Hotel::class)]
    private ?Hotel $hotel = null;

    #[ORM\ManyToOne(targetEntity: Activities::class)]
    private ?Activities $activity = null;

    #[ORM\Column(type: 'integer')]
    private int $quantity;

    // Getters and setters...
}
