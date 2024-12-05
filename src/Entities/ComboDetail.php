<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "ComboDetail")]
class ComboDetail
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $comboDetailId;

    #[ORM\ManyToOne(targetEntity: Combo::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: "CASCADE")]
    private Combo $combo;

    #[ORM\ManyToOne(targetEntity: Flight::class)]
    #[ORM\JoinColumn(nullable: true, onDelete: "CASCADE")]
    private ?Flight $flight = null;

    #[ORM\ManyToOne(targetEntity: Hotel::class)]
    #[ORM\JoinColumn(nullable: true, onDelete: "CASCADE")]
    private ?Hotel $hotel = null;

    #[ORM\ManyToOne(targetEntity: Activity::class)]
    #[ORM\JoinColumn(nullable: true, onDelete: "CASCADE")]
    private ?Activity $activity = null;

    // Getters and setters...
}
