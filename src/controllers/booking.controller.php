<?php

namespace App\Controller;

use App\Dto\BookingDto;
use App\Dto\BookingUpdateDto;
use App\Service\BookingService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class BookingController extends BaseController
{
    private BookingService $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    #[Route('/bookings', name: 'create_booking', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $dto = new BookingDto();
        $dto->userId = $data['userId'];
        $dto->promoId = $data['promoId'];
        $dto->bookingDate = $data['bookingDate'];
        $dto->totalPrice = $data['totalPrice'];
        $dto->status = $data['status'];

        $booking = $this->bookingService->createBooking($dto);

        return $this->successResponse($booking);
    }

    #[Route('/bookings/{id}', name: 'get_booking', methods: ['GET'])]
    public function getById(int $id): JsonResponse
    {
        $booking = $this->bookingService->getBookingById($id);
        return $booking ? $this->successResponse($booking) : $this->errorResponse('Booking not found', 404);
    }

    #[Route('/bookings/{id}', name: 'update_booking', methods: ['PUT'])]
    public function update(int $id, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $dto = new BookingUpdateDto();
        $dto->userId = $data['userId'] ?? null;
        $dto->promoId = $data['promoId'] ?? null;
        $dto->bookingDate = $data['bookingDate'] ?? null;
        $dto->totalPrice = $data['totalPrice'] ?? null;
        $dto->status = $data['status'] ?? null;

        $booking = $this->bookingService->getBookingById($id);
        if (!$booking) {
            return $this->errorResponse('Booking not found', 404);
        }

        $updatedBooking = $this->bookingService->updateBooking($booking, $dto);

        return $this->successResponse($updatedBooking);
    }

    #[Route('/bookings/{id}', name: 'delete_booking', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $booking = $this->bookingService->getBookingById($id);
        if (!$booking) {
            return $this->errorResponse('Booking not found', 404);
        }

        $this->bookingService->deleteBooking($booking);
        return $this->successResponse(['message' => 'Booking deleted successfully']);
    }
}
