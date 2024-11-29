<?php

namespace App\Service;

use App\Entity\BookingDetail;
use App\Dto\BookingDetailDto;
use App\Dto\BookingDetailUpdateDto;
use Doctrine\ORM\EntityManagerInterface;

class BookingDetailService extends BaseService
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager);
    }

    public function createBookingDetail(BookingDetailDto $dto): BookingDetail
    {
        $bookingDetail = new BookingDetail();
        $bookingDetail->setBookingId($dto->bookingId);
        $bookingDetail->setFlightId($dto->flightId);
        $bookingDetail->setHotelId($dto->hotelId);
        $bookingDetail->setActivityId($dto->activityId);
        $bookingDetail->setQuantity($dto->quantity);

        $this->saveEntity($bookingDetail);

        return $bookingDetail;
    }

    public function updateBookingDetail(BookingDetail $bookingDetail, BookingDetailUpdateDto $dto): BookingDetail
    {
        if ($dto->flightId !== null) $bookingDetail->setFlightId($dto->flightId);
        if ($dto->hotelId !== null) $bookingDetail->setHotelId($dto->hotelId);
        if ($dto->activityId !== null) $bookingDetail->setActivityId($dto->activityId);
        if ($dto->quantity !== null) $bookingDetail->setQuantity($dto->quantity);

        $this->saveEntity($bookingDetail);

        return $bookingDetail;
    }

    public function getBookingDetailById(int $id): ?BookingDetail
    {
        return $this->entityManager->getRepository(BookingDetail::class)->find($id);
    }

    public function deleteBookingDetail(BookingDetail $bookingDetail): void
    {
        $this->deleteEntity($bookingDetail);
    }
}
