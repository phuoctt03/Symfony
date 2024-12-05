<?php

namespace App\Service;

use App\Entity\Feedback;
use Doctrine\ORM\EntityManagerInterface;

class FeedbackService
{
    public function __construct(private EntityManagerInterface $entityManager) {}

    public function createFeedback(Feedback $feedback): Feedback
    {
        $this->entityManager->persist($feedback);
        $this->entityManager->flush();
        return $feedback;
    }

    public function getFeedbackById(int $id): ?Feedback
    {
        return $this->entityManager->getRepository(Feedback::class)->find($id);
    }

    public function updateFeedback(Feedback $feedback): Feedback
    {
        $this->entityManager->flush();
        return $feedback;
    }

    public function deleteFeedback(int $id): void
    {
        $feedback = $this->getFeedbackById($id);
        if ($feedback) {
            $this->entityManager->remove($feedback);
            $this->entityManager->flush();
        }
    }
}
