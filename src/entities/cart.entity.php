<?php

namespace App\Entity;

use App\Repository\CartRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CartRepository::class)]
class Cart
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private User $user;

    #[ORM\ManyToOne(targetEntity: Flight::class)]
    private ?Flight $flight = null;

    #[ORM\ManyToOne(targetEntity: Hotel::class)]
    private ?Hotel $hotel = null;

    #[ORM\ManyToOne(targetEntity: Activities::class)]
    private ?Activities $activity = null;

    #[ORM\Column(type: 'integer')]
    private int $quantity;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $createdDate;

    // Getters and setters...
}
