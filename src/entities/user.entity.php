<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string $username;

    #[ORM\Column(type: 'string', length: 255)]
    private string $password;

    #[ORM\Column(type: 'string', length: 255, unique: true)]
    private string $email;

    #[ORM\ManyToOne(targetEntity: Promo::class)]
    private ?Promo $promo = null;

    #[ORM\Column(type: 'string', length: 15, nullable: true)]
    private ?string $phone;

    #[ORM\Column(type: 'string', enumType: Role::class, options: ['default' => 'user'])]
    private string $role = 'user';

    // Getters and setters...
}
