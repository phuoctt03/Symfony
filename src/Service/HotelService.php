<?php

namespace App\Service;

use App\Entity\Hotel;
use Doctrine\ORM\EntityManagerInterface;

class HotelService
{
    public function __construct(private EntityManagerInterface $entityManager) {}

    public function createHotel(Hotel $hotel): Hotel
    {
        $this->entityManager->persist($hotel);
        $this->entityManager->flush();
        return $hotel;
    }

    public function getHotelById(int $id): ?Hotel
    {
        return $this->entityManager->getRepository(Hotel::class)->find($id);
    }

    public function updateHotel(Hotel $hotel): Hotel
    {
        $this->entityManager->flush();
        return $hotel;
    }

    public function deleteHotel(int $id): void
    {
        $hotel = $this->getHotelById($id);
        if ($hotel) {
            $this->entityManager->remove($hotel);
            $this->entityManager->flush();
        }
    }
}
