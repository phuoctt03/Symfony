<?php

namespace App\Controller;

use App\Dto\HotelDto;
use App\Dto\HotelUpdateDto;
use App\Service\HotelService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class HotelController extends BaseController
{
    private HotelService $hotelService;

    public function __construct(HotelService $hotelService)
    {
        $this->hotelService = $hotelService;
    }

    #[Route('/hotels', name: 'create_hotel', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $dto = new HotelDto();
        $dto->name = $data['name'];
        $dto->address = $data['address'];
        $dto->phone = $data['phone'];
        $dto->price = $data['price'];

        $hotel = $this->hotelService->createHotel($dto);

        return $this->successResponse($hotel);
    }

    #[Route('/hotels/{id}', name: 'get_hotel', methods: ['GET'])]
    public function getById(int $id): JsonResponse
    {
        $hotel = $this->hotelService->getHotelById($id);
        return $hotel ? $this->successResponse($hotel) : $this->errorResponse('Hotel not found', 404);
    }

    #[Route('/hotels/{id}', name: 'update_hotel', methods: ['PUT'])]
    public function update(int $id, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $dto = new HotelUpdateDto();
        $dto->name = $data['name'] ?? null;
        $dto->address = $data['address'] ?? null;
        $dto->phone = $data['phone'] ?? null;
        $dto->price = $data['price'] ?? null;

        $hotel = $this->hotelService->getHotelById($id);
        if (!$hotel) {
            return $this->errorResponse('Hotel not found', 404);
        }

        $updatedHotel = $this->hotelService->updateHotel($hotel, $dto);

        return $this->successResponse($updatedHotel);
    }

    #[Route('/hotels/{id}', name: 'delete_hotel', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $hotel = $this->hotelService->getHotelById($id);
        if (!$hotel) {
            return $this->errorResponse('Hotel not found', 404);
        }

        $this->hotelService->deleteHotel($hotel);
        return $this->successResponse(['message' => 'Hotel deleted successfully']);
    }
}
