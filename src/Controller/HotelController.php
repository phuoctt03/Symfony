<?php

namespace App\Controller;

use App\DTO\Request\Hotel\CreateHotelDTO;
use App\DTO\Request\Hotel\UpdateHotelDTO;
use App\DTO\Response\Hotel\HotelResponseDTO;
use App\Service\HotelService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HotelController extends AbstractController
{
    private const HOTEL_ROUTE = '/hotels/{id}';

    public function __construct(private HotelService $hotelService) {}

    #[Route('/hotels', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $dto = new CreateHotelDTO($data);
        $hotel = $this->hotelService->createHotel($dto);

        return $this->json(new HotelResponseDTO($hotel), Response::HTTP_CREATED);
    }

    #[Route(self::HOTEL_ROUTE, methods: ['GET'])]
    public function read(int $id): JsonResponse
    {
        $hotel = $this->hotelService->getHotelById($id);

        if (!$hotel) {
            return $this->json(['message' => 'Hotel not found'], Response::HTTP_NOT_FOUND);
        }

        return $this->json(new HotelResponseDTO($hotel));
    }

    #[Route(self::HOTEL_ROUTE, methods: ['PUT'])]
    public function update(int $id, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $dto = new UpdateHotelDTO($data);
        $dto->id = $id;

        $hotel = $this->hotelService->updateHotel($dto);

        return $this->json(new HotelResponseDTO($hotel));
    }

    #[Route(self::HOTEL_ROUTE, methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $this->hotelService->deleteHotel($id);

        return $this->json(['message' => 'Hotel deleted successfully'], Response::HTTP_NO_CONTENT);
    }
}
