<?php

namespace App\Service;

use App\Entity\Promo;
use Doctrine\ORM\EntityManagerInterface;

class PromoService
{
    public function __construct(private EntityManagerInterface $entityManager) {}

    public function createPromo(Promo $promo): Promo
    {
        $this->entityManager->persist($promo);
        $this->entityManager->flush();
        return $promo;
    }

    public function getPromoById(int $id): ?Promo
    {
        return $this->entityManager->getRepository(Promo::class)->find($id);
    }

    public function updatePromo(Promo $promo): Promo
    {
        $this->entityManager->flush();
        return $promo;
    }

    public function deletePromo(int $id): void
    {
        $promo = $this->getPromoById($id);
        if ($promo) {
            $this->entityManager->remove($promo);
            $this->entityManager->flush();
        }
    }
}
