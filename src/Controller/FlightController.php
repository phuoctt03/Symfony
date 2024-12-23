<?php

namespace App\Controller;

use App\DTO\Request\Flight\CreateFlightDTO;
use App\DTO\Request\Flight\UpdateFlightDTO;
use App\DTO\Response\Flight\FlightResponseDTO;
use App\Service\FlightService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FlightController extends AbstractController
{
    private const FLIGHT_ROUTE = '/flights/{id}';
    public function __construct(private FlightService $flightService) {}

    #[Route('/flights', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $dto = new CreateFlightDTO($data);
        $flight = $this->flightService->createFlight($dto);

        return $this->json(new FlightResponseDTO($flight), Response::HTTP_CREATED);
    }
    #[Route(self::FLIGHT_ROUTE, methods: ['GET'])]
    public function read(int $id): JsonResponse
    {
        $flight = $this->flightService->getFlightById($id);

        if (!$flight) {
            return $this->json(['message' => 'Flight not found'], Response::HTTP_NOT_FOUND);
        }

        return $this->json(new FlightResponseDTO($flight));
    }
    #[Route(self::FLIGHT_ROUTE, methods: ['PUT'])]
    public function update(int $id, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $dto = new UpdateFlightDTO($data);
        $dto->id = $id;

        $flight = $this->flightService->updateFlight($dto);

        return $this->json(new FlightResponseDTO($flight));
    }
    #[Route(self::FLIGHT_ROUTE, methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $this->flightService->deleteFlight($id);

        return $this->json(['message' => 'Flight deleted successfully'], Response::HTTP_NO_CONTENT);
    }
}
