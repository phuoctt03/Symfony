<?php

namespace App\DTO\Request\Feedback;

use Symfony\Component\Validator\Constraints as Assert;

class CreateFeedbackDTO
{
    #[Assert\NotBlank]
    public int $userId;

    #[Assert\NotBlank]
    #[Assert\Choice(choices: ['Flight', 'Hotel', 'Activity', 'Combo'])]
    public string $ratedType;

    #[Assert\NotBlank]
    public int $relatedId;

    #[Assert\NotBlank]
    #[Assert\Range(min: 0, max: 5)]
    public int $rating;

    public ?string $comment = null;
}
