<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "Promo")]
class Promo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $promoId;

    #[ORM\Column(type: 'string', length: 100)]
    private string $name;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: 'decimal', precision: 5, scale: 2)]
    private float $discount;

    #[ORM\Column(type: 'datetime')]
    private \DateTime $createdDate;

    #[ORM\Column(type: 'datetime')]
    private \DateTime $expiredDate;

    #[ORM\Column(type: 'integer')]
    private int $amount;

    #[ORM\Column(type: 'string', enumType: PromoCondition::class)]
    private PromoCondition $conditions;

    // Getters and setters...
}
