<?php

namespace App\Controller;

use App\DTO\Request\Promo\CreatePromoDTO;
use App\DTO\Request\Promo\UpdatePromoDTO;
use App\DTO\Response\Promo\PromoResponseDTO;
use App\Service\PromoService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PromoController extends AbstractController
{
    public function __construct(private PromoService $promoService) {}

    #[Route('/promos', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $dto = new CreatePromoDTO($data);
        $promo = $this->promoService->createPromo($dto);

        return $this->json(new PromoResponseDTO($promo), Response::HTTP_CREATED);
    }

    private const PROMO_ROUTE = '/promos/{id}';

    #[Route(self::PROMO_ROUTE, methods: ['GET'])]
    public function read(int $id): JsonResponse
    {
        $promo = $this->promoService->getPromoById($id);

        if (!$promo) {
            return $this->json(['message' => 'Promo not found'], Response::HTTP_NOT_FOUND);
        }

        return $this->json(new PromoResponseDTO($promo));
    }

    #[Route(self::PROMO_ROUTE, methods: ['PATCH'])]
    public function update(int $id, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $dto = new UpdatePromoDTO($data);
        $dto->id = $id;

        $promo = $this->promoService->updatePromo($dto);

        return $this->json(new PromoResponseDTO($promo));
    }

    #[Route(self::PROMO_ROUTE, methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $this->promoService->deletePromo($id);

        return $this->json(['message' => 'Promo deleted successfully'], Response::HTTP_NO_CONTENT);
    }
}
