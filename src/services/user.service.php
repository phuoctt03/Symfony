<?php

namespace App\Service;

use App\Entity\User;
use App\Dto\UserDto;
use App\Dto\UserUpdateDto;
use Doctrine\ORM\EntityManagerInterface;

class UserService extends BaseService
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager);
    }

    public function createUser(UserDto $dto): User
    {
        $user = new User();
        $user->setUsername($dto->username);
        $user->setPassword(password_hash($dto->password, PASSWORD_BCRYPT));
        $user->setEmail($dto->email);
        $user->setPhone($dto->phone);
        $user->setRole($dto->role);
        $user->setPromoId($dto->promoId);

        $this->saveEntity($user);

        return $user;
    }

    public function updateUser(User $user, UserUpdateDto $dto): User
    {
        if ($dto->username !== null) $user->setUsername($dto->username);
        if ($dto->password !== null) $user->setPassword(password_hash($dto->password, PASSWORD_BCRYPT));
        if ($dto->email !== null) $user->setEmail($dto->email);
        if ($dto->phone !== null) $user->setPhone($dto->phone);
        if ($dto->role !== null) $user->setRole($dto->role);
        if ($dto->promoId !== null) $user->setPromoId($dto->promoId);

        $this->saveEntity($user);

        return $user;
    }

    public function getUserById(int $id): ?User
    {
        return $this->entityManager->getRepository(User::class)->find($id);
    }

    public function deleteUser(User $user): void
    {
        $this->deleteEntity($user);
    }
}
