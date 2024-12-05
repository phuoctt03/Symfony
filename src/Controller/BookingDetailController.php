<?php

namespace App\Controller;

use App\DTO\Request\BookingDetail\CreateBookingDetailDTO;
use App\DTO\Request\BookingDetail\UpdateBookingDetailDTO;
use App\DTO\Response\BookingDetail\BookingDetailResponseDTO;
use App\Service\BookingDetailService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookingDetailController extends AbstractController
{
    private const BOOKING_DETAIL_ROUTE = '/booking-details/{id}';
    public function __construct(private BookingDetailService $bookingDetailService) {}

    #[Route('/booking-details', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $dto = new CreateBookingDetailDTO($data);
        $bookingDetail = $this->bookingDetailService->createBookingDetail($dto);

        return $this->json(new BookingDetailResponseDTO($bookingDetail), Response::HTTP_CREATED);
    }
    #[Route(self::BOOKING_DETAIL_ROUTE, methods: ['GET'])]
    public function read(int $id): JsonResponse
    {
        $bookingDetail = $this->bookingDetailService->getBookingDetailById($id);

        if (!$bookingDetail) {
            return $this->json(['message' => 'Booking Detail not found'], Response::HTTP_NOT_FOUND);
        }

        return $this->json(new BookingDetailResponseDTO($bookingDetail));
    }
    #[Route(self::BOOKING_DETAIL_ROUTE, methods: ['PUT'])]
    public function update(int $id, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $dto = new UpdateBookingDetailDTO($data);
        $dto->id = $id;

        $bookingDetail = $this->bookingDetailService->updateBookingDetail($dto);

        return $this->json(new BookingDetailResponseDTO($bookingDetail));
    }
    #[Route(self::BOOKING_DETAIL_ROUTE, methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $this->bookingDetailService->deleteBookingDetail($id);

        return $this->json(['message' => 'Booking Detail deleted successfully'], Response::HTTP_NO_CONTENT);
    }
}
