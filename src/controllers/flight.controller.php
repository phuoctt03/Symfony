<?php

namespace App\Controller;

use App\Dto\FlightDto;
use App\Dto\FlightUpdateDto;
use App\Service\FlightService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class FlightController extends BaseController
{
    private FlightService $flightService;

    public function __construct(FlightService $flightService)
    {
        $this->flightService = $flightService;
    }

    #[Route('/flights', name: 'create_flight', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $dto = new FlightDto();
        $dto->branch = $data['branch'];
        $dto->startTime = $data['startTime'];
        $dto->endTime = $data['endTime'];
        $dto->startLocation = $data['startLocation'];
        $dto->endLocation = $data['endLocation'];
        $dto->price = $data['price'];

        $flight = $this->flightService->createFlight($dto);

        return $this->successResponse($flight);
    }

    #[Route('/flights/{id}', name: 'get_flight', methods: ['GET'])]
    public function getById(int $id): JsonResponse
    {
        $flight = $this->flightService->getFlightById($id);
        return $flight ? $this->successResponse($flight) : $this->errorResponse('Flight not found', 404);
    }

    #[Route('/flights/{id}', name: 'update_flight', methods: ['PUT'])]
    public function update(int $id, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $dto = new FlightUpdateDto();
        $dto->branch = $data['branch'] ?? null;
        $dto->startTime = $data['startTime'] ?? null;
        $dto->endTime = $data['endTime'] ?? null;
        $dto->startLocation = $data['startLocation'] ?? null;
        $dto->endLocation = $data['endLocation'] ?? null;
        $dto->price = $data['price'] ?? null;

        $flight = $this->flightService->getFlightById($id);
        if (!$flight) {
            return $this->errorResponse('Flight not found', 404);
        }

        $updatedFlight = $this->flightService->updateFlight($flight, $dto);

        return $this->successResponse($updatedFlight);
    }

    #[Route('/flights/{id}', name: 'delete_flight', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $flight = $this->flightService->getFlightById($id);
        if (!$flight) {
            return $this->errorResponse('Flight not found', 404);
        }

        $this->flightService->deleteFlight($flight);
        return $this->successResponse(['message' => 'Flight deleted successfully']);
    }
}
