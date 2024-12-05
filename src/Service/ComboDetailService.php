<?php

namespace App\Service;

use App\Entity\ComboDetail;
use Doctrine\ORM\EntityManagerInterface;

class ComboDetailService
{
    public function __construct(private EntityManagerInterface $entityManager) {}

    public function createComboDetail(ComboDetail $comboDetail): ComboDetail
    {
        $this->entityManager->persist($comboDetail);
        $this->entityManager->flush();
        return $comboDetail;
    }

    public function getComboDetailById(int $id): ?ComboDetail
    {
        return $this->entityManager->getRepository(ComboDetail::class)->find($id);
    }

    public function updateComboDetail(ComboDetail $comboDetail): ComboDetail
    {
        $this->entityManager->flush();
        return $comboDetail;
    }

    public function deleteComboDetail(int $id): void
    {
        $comboDetail = $this->getComboDetailById($id);
        if ($comboDetail) {
            $this->entityManager->remove($comboDetail);
            $this->entityManager->flush();
        }
    }
}
