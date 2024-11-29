<?php

namespace App\Controller;

use App\Dto\BookingDetailDto;
use App\Dto\BookingDetailUpdateDto;
use App\Service\BookingDetailService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class BookingDetailController extends BaseController
{
    private BookingDetailService $bookingDetailService;

    public function __construct(BookingDetailService $bookingDetailService)
    {
        $this->bookingDetailService = $bookingDetailService;
    }

    #[Route('/bookingdetails', name: 'create_booking_detail', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $dto = new BookingDetailDto();
        $dto->bookingId = $data['bookingId'];
        $dto->flightId = $data['flightId'];
        $dto->hotelId = $data['hotelId'];
        $dto->activityId = $data['activityId'];
        $dto->quantity = $data['quantity'];

        $bookingDetail = $this->bookingDetailService->createBookingDetail($dto);

        return $this->successResponse($bookingDetail);
    }

    #[Route('/bookingdetails/{id}', name: 'get_booking_detail', methods: ['GET'])]
    public function getById(int $id): JsonResponse
    {
        $bookingDetail = $this->bookingDetailService->getBookingDetailById($id);
        return $bookingDetail ? $this->successResponse($bookingDetail) : $this->errorResponse('Booking Detail not found', 404);
    }

    #[Route('/bookingdetails/{id}', name: 'update_booking_detail', methods: ['PUT'])]
    public function update(int $id, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $dto = new BookingDetailUpdateDto();
        $dto->flightId = $data['flightId'] ?? null;
        $dto->hotelId = $data['hotelId'] ?? null;
        $dto->activityId = $data['activityId'] ?? null;
        $dto->quantity = $data['quantity'] ?? null;

        $bookingDetail = $this->bookingDetailService->getBookingDetailById($id);
        if (!$bookingDetail) {
            return $this->errorResponse('Booking Detail not found', 404);
        }

        $updatedBookingDetail = $this->bookingDetailService->updateBookingDetail($bookingDetail, $dto);

        return $this->successResponse($updatedBookingDetail);
    }

    #[Route('/bookingdetails/{id}', name: 'delete_booking_detail', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $bookingDetail = $this->bookingDetailService->getBookingDetailById($id);
        if (!$bookingDetail) {
            return $this->errorResponse('Booking Detail not found', 404);
        }

        $this->bookingDetailService->deleteBookingDetail($bookingDetail);
        return $this->successResponse(['message' => 'Booking Detail deleted successfully']);
    }
}
