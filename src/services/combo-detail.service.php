<?php

namespace App\Service;

use App\Entity\ComboDetail;
use App\Dto\ComboDetailDto;
use App\Dto\ComboDetailUpdateDto;
use Doctrine\ORM\EntityManagerInterface;

class ComboDetailService extends BaseService
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager);
    }

    public function createComboDetail(ComboDetailDto $dto): ComboDetail
    {
        $comboDetail = new ComboDetail();
        $comboDetail->setComboId($dto->comboId);
        $comboDetail->setFlightId($dto->flightId);
        $comboDetail->setHotelId($dto->hotelId);
        $comboDetail->setActivityId($dto->activityId);

        $this->saveEntity($comboDetail);

        return $comboDetail;
    }

    public function updateComboDetail(ComboDetail $comboDetail, ComboDetailUpdateDto $dto): ComboDetail
    {
        if ($dto->flightId !== null) $comboDetail->setFlightId($dto->flightId);
        if ($dto->hotelId !== null) $comboDetail->setHotelId($dto->hotelId);
        if ($dto->activityId !== null) $comboDetail->setActivityId($dto->activityId);

        $this->saveEntity($comboDetail);

        return $comboDetail;
    }

    public function getComboDetailById(int $id): ?ComboDetail
    {
        return $this->entityManager->getRepository(ComboDetail::class)->find($id);
    }

    public function deleteComboDetail(ComboDetail $comboDetail): void
    {
        $this->deleteEntity($comboDetail);
    }
}
