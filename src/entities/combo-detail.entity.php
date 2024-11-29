<?php

namespace App\Entity;

use App\Repository\ComboDetailRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ComboDetailRepository::class)]
class ComboDetail
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Combo::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Combo $combo;

    #[ORM\ManyToOne(targetEntity: Flight::class)]
    private ?Flight $flight = null;

    #[ORM\ManyToOne(targetEntity: Hotel::class)]
    private ?Hotel $hotel = null;

    #[ORM\ManyToOne(targetEntity: Activities::class)]
    private ?Activities $activity = null;

    // Getters and setters...
}
