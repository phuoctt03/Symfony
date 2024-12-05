<?php

namespace App\Service;

use App\Entity\BookingDetail;
use Doctrine\ORM\EntityManagerInterface;

class BookingDetailService
{
    public function __construct(private EntityManagerInterface $entityManager) {}

    public function createBookingDetail(BookingDetail $bookingDetail): BookingDetail
    {
        $this->entityManager->persist($bookingDetail);
        $this->entityManager->flush();
        return $bookingDetail;
    }

    public function getBookingDetailById(int $id): ?BookingDetail
    {
        return $this->entityManager->getRepository(BookingDetail::class)->find($id);
    }

    public function updateBookingDetail(BookingDetail $bookingDetail): BookingDetail
    {
        $this->entityManager->flush();
        return $bookingDetail;
    }

    public function deleteBookingDetail(int $id): void
    {
        $bookingDetail = $this->getBookingDetailById($id);
        if ($bookingDetail) {
            $this->entityManager->remove($bookingDetail);
            $this->entityManager->flush();
        }
    }
}
