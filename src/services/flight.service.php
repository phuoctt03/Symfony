<?php

namespace App\Service;

use App\Entity\Flight;
use App\Dto\FlightDto;
use App\Dto\FlightUpdateDto;
use Doctrine\ORM\EntityManagerInterface;

class FlightService extends BaseService
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager);
    }

    public function createFlight(FlightDto $dto): Flight
    {
        $flight = new Flight();
        $flight->setBranch($dto->branch);
        $flight->setStartTime($dto->startTime);
        $flight->setEndTime($dto->endTime);
        $flight->setStartLocation($dto->startLocation);
        $flight->setEndLocation($dto->endLocation);
        $flight->setPrice($dto->price);

        $this->saveEntity($flight);

        return $flight;
    }

    public function updateFlight(Flight $flight, FlightUpdateDto $dto): Flight
    {
        if ($dto->branch !== null) $flight->setBranch($dto->branch);
        if ($dto->startTime !== null) $flight->setStartTime($dto->startTime);
        if ($dto->endTime !== null) $flight->setEndTime($dto->endTime);
        if ($dto->startLocation !== null) $flight->setStartLocation($dto->startLocation);
        if ($dto->endLocation !== null) $flight->setEndLocation($dto->endLocation);
        if ($dto->price !== null) $flight->setPrice($dto->price);

        $this->saveEntity($flight);

        return $flight;
    }

    public function getFlightById(int $id): ?Flight
    {
        return $this->entityManager->getRepository(Flight::class)->find($id);
    }

    public function deleteFlight(Flight $flight): void
    {
        $this->deleteEntity($flight);
    }
}
