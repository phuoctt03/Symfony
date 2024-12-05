<?php

namespace App\Service;

use App\Entity\Combo;
use Doctrine\ORM\EntityManagerInterface;

class ComboService
{
    public function __construct(private EntityManagerInterface $entityManager) {}

    public function createCombo(Combo $combo): Combo
    {
        $this->entityManager->persist($combo);
        $this->entityManager->flush();
        return $combo;
    }

    public function getComboById(int $id): ?Combo
    {
        return $this->entityManager->getRepository(Combo::class)->find($id);
    }

    public function updateCombo(Combo $combo): Combo
    {
        $this->entityManager->flush();
        return $combo;
    }

    public function deleteCombo(int $id): void
    {
        $combo = $this->getComboById($id);
        if ($combo) {
            $this->entityManager->remove($combo);
            $this->entityManager->flush();
        }
    }
}
