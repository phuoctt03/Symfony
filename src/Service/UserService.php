<?php

namespace App\Service;

use App\DTO\Request\User\CreateUserDTO;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserService
{
    public function __construct(private EntityManagerInterface $entityManager) {}

    public function createUser(CreateUserDTO $dto): User
    {
        $user = new User();
        $user->setEmail($dto->getEmail());
        $user->setPassword($this->passwordEncoder->encodePassword($user, $dto->getPassword()));
        $user->setRoles($dto->getRoles());

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }

    public function getUserById(int $id): ?User
    {
        return $this->entityManager->getRepository(User::class)->find($id);
    }

    public function updateUser(User $user): User
    {
        $this->entityManager->flush();
        return $user;
    }

    public function deleteUser(int $id): void
    {
        $user = $this->getUserById($id);
        if ($user) {
            $this->entityManager->remove($user);
            $this->entityManager->flush();
        }
    }
}
