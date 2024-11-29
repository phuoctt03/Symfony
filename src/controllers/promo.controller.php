<?php

namespace App\Controller;

use App\Dto\PromoDto;
use App\Dto\PromoUpdateDto;
use App\Service\PromoService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class PromoController extends BaseController
{
    private PromoService $promoService;

    public function __construct(PromoService $promoService)
    {
        $this->promoService = $promoService;
    }

    #[Route('/promos', name: 'create_promo', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $dto = new PromoDto();
        $dto->name = $data['name'];
        $dto->description = $data['description'];
        $dto->discount = $data['discount'];
        $dto->expiredDate = $data['expiredDate'];
        $dto->amount = $data['amount'];
        $dto->conditions = $data['conditions'];

        $promo = $this->promoService->createPromo($dto);

        return $this->successResponse($promo);
    }

    #[Route('/promos/{id}', name: 'get_promo', methods: ['GET'])]
    public function getById(int $id): JsonResponse
    {
        $promo = $this->promoService->getPromoById($id);
        return $promo ? $this->successResponse($promo) : $this->errorResponse('Promo not found', 404);
    }

    #[Route('/promos/{id}', name: 'update_promo', methods: ['PUT'])]
    public function update(int $id, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $dto = new PromoUpdateDto();
        $dto->name = $data['name'] ?? null;
        $dto->description = $data['description'] ?? null;
        $dto->discount = $data['discount'] ?? null;
        $dto->expiredDate = $data['expiredDate'] ?? null;
        $dto->amount = $data['amount'] ?? null;
        $dto->conditions = $data['conditions'] ?? null;

        $promo = $this->promoService->getPromoById($id);
        if (!$promo) {
            return $this->errorResponse('Promo not found', 404);
        }

        $updatedPromo = $this->promoService->updatePromo($promo, $dto);

        return $this->successResponse($updatedPromo);
    }

    #[Route('/promos/{id}', name: 'delete_promo', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $promo = $this->promoService->getPromoById($id);
        if (!$promo) {
            return $this->errorResponse('Promo not found', 404);
        }

        $this->promoService->deletePromo($promo);
        return $this->successResponse(['message' => 'Promo deleted successfully']);
    }
}
