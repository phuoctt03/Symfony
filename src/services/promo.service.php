<?php

namespace App\Service;

use App\Entity\Promo;
use App\Dto\PromoDto;
use App\Dto\PromoUpdateDto;
use Doctrine\ORM\EntityManagerInterface;

class PromoService extends BaseService
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager);
    }

    public function createPromo(PromoDto $dto): Promo
    {
        $promo = new Promo();
        $promo->setName($dto->name);
        $promo->setDescription($dto->description);
        $promo->setDiscount($dto->discount);
        $promo->setExpiredDate($dto->expiredDate);
        $promo->setAmount($dto->amount);
        $promo->setConditions($dto->conditions);

        $this->saveEntity($promo);

        return $promo;
    }

    public function updatePromo(Promo $promo, PromoUpdateDto $dto): Promo
    {
        if ($dto->name !== null) $promo->setName($dto->name);
        if ($dto->description !== null) $promo->setDescription($dto->description);
        if ($dto->discount !== null) $promo->setDiscount($dto->discount);
        if ($dto->expiredDate !== null) $promo->setExpiredDate($dto->expiredDate);
        if ($dto->amount !== null) $promo->setAmount($dto->amount);
        if ($dto->conditions !== null) $promo->setConditions($dto->conditions);

        $this->saveEntity($promo);

        return $promo;
    }

    public function getPromoById(int $id): ?Promo
    {
        return $this->entityManager->getRepository(Promo::class)->find($id);
    }

    public function deletePromo(Promo $promo): void
    {
        $this->deleteEntity($promo);
    }
}
