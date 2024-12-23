<?php

namespace App\Controller;

use App\DTO\Request\Payment\CreatePaymentDTO;
use App\DTO\Request\Payment\UpdatePaymentDTO;
use App\DTO\Response\Payment\PaymentResponseDTO;
use App\Service\PaymentService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PaymentController extends AbstractController
{
    private const PAYMENT_ROUTE = '/payments/{id}';
    public function __construct(private PaymentService $paymentService) {}

    #[Route('/payments', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $dto = new CreatePaymentDTO($data);
        $payment = $this->paymentService->createPayment($dto);

        return $this->json(new PaymentResponseDTO($payment), Response::HTTP_CREATED);
    }
    #[Route(self::PAYMENT_ROUTE, methods: ['GET'])]
    public function read(int $id): JsonResponse
    {
        $payment = $this->paymentService->getPaymentById($id);

        if (!$payment) {
            return $this->json(['message' => 'Payment not found'], Response::HTTP_NOT_FOUND);
        }

        return $this->json(new PaymentResponseDTO($payment));
    }
    #[Route(self::PAYMENT_ROUTE, methods: ['PUT'])]
    public function update(int $id, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $dto = new UpdatePaymentDTO($data);
        $dto->id = $id;

        $payment = $this->paymentService->updatePayment($dto);

        return $this->json(new PaymentResponseDTO($payment));
    }
    #[Route(self::PAYMENT_ROUTE, methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $this->paymentService->deletePayment($id);

        return $this->json(['message' => 'Payment deleted successfully'], Response::HTTP_NO_CONTENT);
    }
}
