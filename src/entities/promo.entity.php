<?php

namespace App\Entity;

use App\Repository\PromoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PromoRepository::class)]
class Promo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $description;

    #[ORM\Column(type: 'decimal', precision: 5, scale: 2)]
    private float $discount;

    #[ORM\Column(type: 'date')]
    private \DateTimeInterface $expiredDate;

    #[ORM\Column(type: 'integer')]
    private int $amount;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $conditions;

    // Getters and setters...
}
