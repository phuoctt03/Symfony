<?php

namespace App\Entity;

use App\Repository\HotelRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HotelRepository::class)]
class Hotel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\Column(type: 'text')]
    private string $address;

    #[ORM\Column(type: 'string', length: 15, nullable: true)]
    private ?string $phone;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private float $price;

    // Getters and setters...
}
