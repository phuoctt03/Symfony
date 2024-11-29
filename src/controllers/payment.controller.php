<?php

namespace App\Controller;

use App\Dto\PaymentDto;
use App\Dto\PaymentUpdateDto;
use App\Service\PaymentService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class PaymentController extends BaseController
{
    private PaymentService $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    #[Route('/payments', name: 'create_payment', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $dto = new PaymentDto();
        $dto->userId = $data['userId'];
        $dto->bookingId = $data['bookingId'];
        $dto->paymentDate = $data['paymentDate'];
        $dto->paymentMethod = $data['paymentMethod'];
        $dto->status = $data['status'];

        $payment = $this->paymentService->createPayment($dto);

        return $this->successResponse($payment);
    }

    #[Route('/payments/{id}', name: 'get_payment', methods: ['GET'])]
    public function getById(int $id): JsonResponse
    {
        $payment = $this->paymentService->getPaymentById($id);
        return $payment ? $this->successResponse($payment) : $this->errorResponse('Payment not found', 404);
    }

    #[Route('/payments/{id}', name: 'update_payment', methods: ['PUT'])]
    public function update(int $id, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $dto = new PaymentUpdateDto();
        $dto->userId = $data['userId'] ?? null;
        $dto->bookingId = $data['bookingId'] ?? null;
        $dto->paymentDate = $data['paymentDate'] ?? null;
        $dto->paymentMethod = $data['paymentMethod'] ?? null;
        $dto->status = $data['status'] ?? null;

        $payment = $this->paymentService->getPaymentById($id);
        if (!$payment) {
            return $this->errorResponse('Payment not found', 404);
        }

        $updatedPayment = $this->paymentService->updatePayment($payment, $dto);

        return $this->successResponse($updatedPayment);
    }

    #[Route('/payments/{id}', name: 'delete_payment', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $payment = $this->paymentService->getPaymentById($id);
        if (!$payment) {
            return $this->errorResponse('Payment not found', 404);
        }

        $this->paymentService->deletePayment($payment);
        return $this->successResponse(['message' => 'Payment deleted successfully']);
    }
}
