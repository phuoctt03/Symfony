<?php

namespace App\Service;

use App\Entity\Payment;
use Doctrine\ORM\EntityManagerInterface;

class PaymentService
{
    public function __construct(private EntityManagerInterface $entityManager) {}

    public function createPayment(Payment $payment): Payment
    {
        $this->entityManager->persist($payment);
        $this->entityManager->flush();
        return $payment;
    }

    public function getPaymentById(int $id): ?Payment
    {
        return $this->entityManager->getRepository(Payment::class)->find($id);
    }

    public function updatePayment(Payment $payment): Payment
    {
        $this->entityManager->flush();
        return $payment;
    }

    public function deletePayment(int $id): void
    {
        $payment = $this->getPaymentById($id);
        if ($payment) {
            $this->entityManager->remove($payment);
            $this->entityManager->flush();
        }
    }
}
