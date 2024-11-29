<?php

namespace App\Service;

use App\Entity\Hotel;
use App\Dto\HotelDto;
use App\Dto\HotelUpdateDto;
use Doctrine\ORM\EntityManagerInterface;

class HotelService extends BaseService
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager);
    }

    public function createHotel(HotelDto $dto): Hotel
    {
        $hotel = new Hotel();
        $hotel->setName($dto->name);
        $hotel->setAddress($dto->address);
        $hotel->setPhone($dto->phone);
        $hotel->setPrice($dto->price);

        $this->saveEntity($hotel);

        return $hotel;
    }

    public function updateHotel(Hotel $hotel, HotelUpdateDto $dto): Hotel
    {
        if ($dto->name !== null) $hotel->setName($dto->name);
        if ($dto->address !== null) $hotel->setAddress($dto->address);
        if ($dto->phone !== null) $hotel->setPhone($dto->phone);
        if ($dto->price !== null) $hotel->setPrice($dto->price);

        $this->saveEntity($hotel);

        return $hotel;
    }

    public function getHotelById(int $id): ?Hotel
    {
        return $this->entityManager->getRepository(Hotel::class)->find($id);
    }

    public function deleteHotel(Hotel $hotel): void
    {
        $this->deleteEntity($hotel);
    }
}
