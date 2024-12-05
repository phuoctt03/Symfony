<?php

namespace App\Service;

use App\Entity\Flight;
use Doctrine\ORM\EntityManagerInterface;

class FlightService
{
    public function __construct(private EntityManagerInterface $entityManager) {}

    public function createFlight(Flight $flight): Flight
    {
        $this->entityManager->persist($flight);
        $this->entityManager->flush();
        return $flight;
    }

    public function getFlightById(int $id): ?Flight
    {
        return $this->entityManager->getRepository(Flight::class)->find($id);
    }

    public function updateFlight(Flight $flight): Flight
    {
        $this->entityManager->flush();
        return $flight;
    }

    public function deleteFlight(int $id): void
    {
        $flight = $this->getFlightById($id);
        if ($flight) {
            $this->entityManager->remove($flight);
            $this->entityManager->flush();
        }
    }
}
