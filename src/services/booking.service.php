<?php

namespace App\Service;

use App\Entity\Booking;
use App\Dto\BookingDto;
use App\Dto\BookingUpdateDto;
use Doctrine\ORM\EntityManagerInterface;

class BookingService extends BaseService
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager);
    }

    public function createBooking(BookingDto $dto): Booking
    {
        $booking = new Booking();
        $booking->setUserId($dto->userId);
        $booking->setPromoId($dto->promoId);
        $booking->setBookingDate($dto->bookingDate);
        $booking->setTotalPrice($dto->totalPrice);
        $booking->setStatus($dto->status);

        $this->saveEntity($booking);

        return $booking;
    }

    public function updateBooking(Booking $booking, BookingUpdateDto $dto): Booking
    {
        if ($dto->promoId !== null) $booking->setPromoId($dto->promoId);
        if ($dto->totalPrice !== null) $booking->setTotalPrice($dto->totalPrice);
        if ($dto->status !== null) $booking->setStatus($dto->status);

        $this->saveEntity($booking);

        return $booking;
    }

    public function getBookingById(int $id): ?Booking
    {
        return $this->entityManager->getRepository(Booking::class)->find($id);
    }

    public function deleteBooking(Booking $booking): void
    {
        $this->deleteEntity($booking);
    }
}
