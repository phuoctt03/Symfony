<?php

namespace App\Dto;

class FeedbackDto
{
    public ?int $id = null;
    public int $userId;
    public string $relatedType;
    public int $relatedId;
    public int $rating;
    public ?string $comment = null;
    public \DateTimeInterface $createdDate;
}
