<?php

namespace App\Entity;

use App\Repository\FlightRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FlightRepository::class)]
class Flight
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string $branch;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $startTime;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $endTime;

    #[ORM\Column(type: 'string', length: 255)]
    private string $startLocation;

    #[ORM\Column(type: 'string', length: 255)]
    private string $endLocation;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private float $price;

    // Getters and setters...
}
