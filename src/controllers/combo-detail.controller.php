<?php

namespace App\Controller;

use App\Dto\ComboDetailDto;
use App\Dto\ComboDetailUpdateDto;
use App\Service\ComboDetailService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class ComboDetailController extends BaseController
{
    private ComboDetailService $comboDetailService;

    public function __construct(ComboDetailService $comboDetailService)
    {
        $this->comboDetailService = $comboDetailService;
    }

    #[Route('/combo-details', name: 'create_combo_detail', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $dto = new ComboDetailDto();
        $dto->comboId = $data['comboId'];
        $dto->flightId = $data['flightId'];
        $dto->hotelId = $data['hotelId'];
        $dto->activityId = $data['activityId'];

        $comboDetail = $this->comboDetailService->createComboDetail($dto);

        return $this->successResponse($comboDetail);
    }

    #[Route('/combo-details/{id}', name: 'get_combo_detail', methods: ['GET'])]
    public function getById(int $id): JsonResponse
    {
        $comboDetail = $this->comboDetailService->getComboDetailById($id);
        return $comboDetail ? $this->successResponse($comboDetail) : $this->errorResponse('Combo Detail not found', 404);
    }

    #[Route('/combo-details/{id}', name: 'update_combo_detail', methods: ['PUT'])]
    public function update(int $id, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $dto = new ComboDetailUpdateDto();
        $dto->comboId = $data['comboId'] ?? null;
        $dto->flightId = $data['flightId'] ?? null;
        $dto->hotelId = $data['hotelId'] ?? null;
        $dto->activityId = $data['activityId'] ?? null;

        $comboDetail = $this->comboDetailService->getComboDetailById($id);
        if (!$comboDetail) {
            return $this->errorResponse('Combo Detail not found', 404);
        }

        $updatedComboDetail = $this->comboDetailService->updateComboDetail($comboDetail, $dto);

        return $this->successResponse($updatedComboDetail);
    }

    #[Route('/combo-details/{id}', name: 'delete_combo_detail', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $comboDetail = $this->comboDetailService->getComboDetailById($id);
        if (!$comboDetail) {
            return $this->errorResponse('Combo Detail not found', 404);
        }

        $this->comboDetailService->deleteComboDetail($comboDetail);
        return $this->successResponse(['message' => 'Combo Detail deleted successfully']);
    }
}
