<?php

namespace App\Service;

use App\Entity\Feedback;
use App\Dto\FeedbackDto;
use App\Dto\FeedbackUpdateDto;
use Doctrine\ORM\EntityManagerInterface;

class FeedbackService extends BaseService
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager);
    }

    public function createFeedback(FeedbackDto $dto): Feedback
    {
        $feedback = new Feedback();
        $feedback->setUserId($dto->userId);
        $feedback->setRelatedType($dto->relatedType);
        $feedback->setRelatedId($dto->relatedId);
        $feedback->setRating($dto->rating);
        $feedback->setComment($dto->comment);
        $feedback->setCreatedDate($dto->createdDate);

        $this->saveEntity($feedback);

        return $feedback;
    }

    public function updateFeedback(Feedback $feedback, FeedbackUpdateDto $dto): Feedback
    {
        if ($dto->rating !== null) $feedback->setRating($dto->rating);
        if ($dto->comment !== null) $feedback->setComment($dto->comment);

        $this->saveEntity($feedback);

        return $feedback;
    }

    public function getFeedbackById(int $id): ?Feedback
    {
        return $this->entityManager->getRepository(Feedback::class)->find($id);
    }

    public function deleteFeedback(Feedback $feedback): void
    {
        $this->deleteEntity($feedback);
    }
}
