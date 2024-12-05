<?php

namespace App\DTO\Response\Feedback;

class FeedbackResponseDTO
{
    public int $id;
    public int $userId;
    public string $ratedType;
    public int $relatedId;
    public int $rating;
    public ?string $comment;
    public \DateTimeInterface $createdDate;
}
