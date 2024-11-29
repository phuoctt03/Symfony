<?php

namespace App\Service;

use App\Entity\Payment;
use App\Dto\PaymentDto;
use App\Dto\PaymentUpdateDto;
use Doctrine\ORM\EntityManagerInterface;

class PaymentService extends BaseService
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager);
    }

    public function createPayment(PaymentDto $dto): Payment
    {
        $payment = new Payment();
        $payment->setUserId($dto->userId);
        $payment->setBookingId($dto->bookingId);
        $payment->setPaymentDate($dto->paymentDate);
        $payment->setPaymentMethod($dto->paymentMethod);
        $payment->setStatus($dto->status);

        $this->saveEntity($payment);

        return $payment;
    }

    public function updatePayment(Payment $payment, PaymentUpdateDto $dto): Payment
    {
        if ($dto->paymentDate !== null) $payment->setPaymentDate($dto->paymentDate);
        if ($dto->paymentMethod !== null) $payment->setPaymentMethod($dto->paymentMethod);
        if ($dto->status !== null) $payment->setStatus($dto->status);

        $this->saveEntity($payment);

        return $payment;
    }

    public function getPaymentById(int $id): ?Payment
    {
        return $this->entityManager->getRepository(Payment::class)->find($id);
    }

    public function deletePayment(Payment $payment): void
    {
        $this->deleteEntity($payment);
    }
}
