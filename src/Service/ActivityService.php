<?php

namespace App\Service;

use App\Entity\Activity;
use Doctrine\ORM\EntityManagerInterface;

class ActivityService
{
    public function __construct(private EntityManagerInterface $entityManager) {}

    public function createActivity(Activity $activity): Activity
    {
        $this->entityManager->persist($activity);
        $this->entityManager->flush();
        return $activity;
    }

    public function getActivityById(int $id): ?Activity
    {
        return $this->entityManager->getRepository(Activity::class)->find($id);
    }

    public function updateActivity(Activity $activity): Activity
    {
        $this->entityManager->flush();
        return $activity;
    }

    public function deleteActivity(int $id): void
    {
        $activity = $this->getActivityById($id);
        if ($activity) {
            $this->entityManager->remove($activity);
            $this->entityManager->flush();
        }
    }
}
