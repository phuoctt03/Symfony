<?php

namespace App\Service;

use App\Entity\Booking;
use Doctrine\ORM\EntityManagerInterface;

class BookingService
{
    public function __construct(private EntityManagerInterface $entityManager) {}

    public function createBooking(Booking $booking): Booking
    {
        $this->entityManager->persist($booking);
        $this->entityManager->flush();
        return $booking;
    }

    public function getBookingById(int $id): ?Booking
    {
        return $this->entityManager->getRepository(Booking::class)->find($id);
    }

    public function updateBooking(Booking $booking): Booking
    {
        $this->entityManager->flush();
        return $booking;
    }

    public function deleteBooking(int $id): void
    {
        $booking = $this->getBookingById($id);
        if ($booking) {
            $this->entityManager->remove($booking);
            $this->entityManager->flush();
        }
    }
}
