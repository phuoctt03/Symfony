<?php

namespace App\Controller;

use App\Dto\ComboDto;
use App\Dto\ComboUpdateDto;
use App\Service\ComboService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class ComboController extends BaseController
{
    private ComboService $comboService;

    public function __construct(ComboService $comboService)
    {
        $this->comboService = $comboService;
    }

    #[Route('/combos', name: 'create_combo', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $dto = new ComboDto();
        $dto->name = $data['name'];
        $dto->description = $data['description'];
        $dto->price = $data['price'];
        $dto->promoId = $data['promoId'];

        $combo = $this->comboService->createCombo($dto);

        return $this->successResponse($combo);
    }

    #[Route('/combos/{id}', name: 'get_combo', methods: ['GET'])]
    public function getById(int $id): JsonResponse
    {
        $combo = $this->comboService->getComboById($id);
        return $combo ? $this->successResponse($combo) : $this->errorResponse('Combo not found', 404);
    }

    #[Route('/combos/{id}', name: 'update_combo', methods: ['PUT'])]
    public function update(int $id, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $dto = new ComboUpdateDto();
        $dto->name = $data['name'] ?? null;
        $dto->description = $data['description'] ?? null;
        $dto->price = $data['price'] ?? null;
        $dto->promoId = $data['promoId'] ?? null;

        $combo = $this->comboService->getComboById($id);
        if (!$combo) {
            return $this->errorResponse('Combo not found', 404);
        }

        $updatedCombo = $this->comboService->updateCombo($combo, $dto);

        return $this->successResponse($updatedCombo);
    }

    #[Route('/combos/{id}', name: 'delete_combo', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $combo = $this->comboService->getComboById($id);
        if (!$combo) {
            return $this->errorResponse('Combo not found', 404);
        }

        $this->comboService->deleteCombo($combo);
        return $this->successResponse(['message' => 'Combo deleted successfully']);
    }
}
