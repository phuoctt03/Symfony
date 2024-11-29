<?php

namespace App\Service;

use App\Entity\Activities;
use App\Dto\ActivitiesDto;
use App\Dto\ActivitiesUpdateDto;
use Doctrine\ORM\EntityManagerInterface;

class ActivityService extends BaseService
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager);
    }

    public function createActivity(ActivitiesDto $dto): Activities
    {
        $activity = new Activities();
        $activity->setName($dto->name);
        $activity->setPrice($dto->price);
        $activity->setDescription($dto->description);

        $this->saveEntity($activity);

        return $activity;
    }

    public function updateActivity(Activities $activity, ActivitiesUpdateDto $dto): Activities
    {
        if ($dto->name !== null) $activity->setName($dto->name);
        if ($dto->price !== null) $activity->setPrice($dto->price);
        if ($dto->description !== null) $activity->setDescription($dto->description);

        $this->saveEntity($activity);

        return $activity;
    }

    public function getActivityById(int $id): ?Activities
    {
        return $this->entityManager->getRepository(Activities::class)->find($id);
    }

    public function deleteActivity(Activities $activity): void
    {
        $this->deleteEntity($activity);
    }
}
