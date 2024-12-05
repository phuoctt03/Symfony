<?php

namespace App\DTO\Request\ComboDetail;

use Symfony\Component\Validator\Constraints as Assert;

class CreateComboDetailDTO
{
    #[Assert\NotBlank]
    public int $comboId;

    public ?int $flightId = null;
    public ?int $hotelId = null;
    public ?int $activityId = null;
}
