<?php

namespace App\Service;

use App\Entity\Combo;
use App\Dto\ComboDto;
use App\Dto\ComboUpdateDto;
use Doctrine\ORM\EntityManagerInterface;

class ComboService extends BaseService
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager);
    }

    public function createCombo(ComboDto $dto): Combo
    {
        $combo = new Combo();
        $combo->setName($dto->name);
        $combo->setDescription($dto->description);
        $combo->setPrice($dto->price);
        $combo->setPromoId($dto->promoId);

        $this->saveEntity($combo);

        return $combo;
    }

    public function updateCombo(Combo $combo, ComboUpdateDto $dto): Combo
    {
        if ($dto->name !== null) $combo->setName($dto->name);
        if ($dto->description !== null) $combo->setDescription($dto->description);
        if ($dto->price !== null) $combo->setPrice($dto->price);
        if ($dto->promoId !== null) $combo->setPromoId($dto->promoId);

        $this->saveEntity($combo);

        return $combo;
    }

    public function getComboById(int $id): ?Combo
    {
        return $this->entityManager->getRepository(Combo::class)->find($id);
    }

    public function deleteCombo(Combo $combo): void
    {
        $this->deleteEntity($combo);
    }
}
