<?php

namespace App\Controller;

use App\DTO\Request\ComboDetail\CreateComboDetailDTO;
use App\DTO\Request\ComboDetail\UpdateComboDetailDTO;
use App\DTO\Response\ComboDetail\ComboDetailResponseDTO;
use App\Service\ComboDetailService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ComboDetailController extends AbstractController
{
    private const COMBO_DETAIL_ROUTE = '/combo-details/{id}';
    public function __construct(private ComboDetailService $comboDetailService) {}

    #[Route('/combo-details', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $dto = new CreateComboDetailDTO($data);
        $comboDetail = $this->comboDetailService->createComboDetail($dto);

        return $this->json(new ComboDetailResponseDTO($comboDetail), Response::HTTP_CREATED);
    }
    #[Route(self::COMBO_DETAIL_ROUTE, methods: ['GET'])]
    public function read(int $id): JsonResponse
    {
        $comboDetail = $this->comboDetailService->getComboDetailById($id);

        if (!$comboDetail) {
            return $this->json(['message' => 'Combo Detail not found'], Response::HTTP_NOT_FOUND);
        }

        return $this->json(new ComboDetailResponseDTO($comboDetail));
    }
    #[Route(self::COMBO_DETAIL_ROUTE, methods: ['PUT'])]
    public function update(int $id, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $dto = new UpdateComboDetailDTO($data);
        $dto->id = $id;

        $comboDetail = $this->comboDetailService->updateComboDetail($dto);

        return $this->json(new ComboDetailResponseDTO($comboDetail));
    }
    #[Route(self::COMBO_DETAIL_ROUTE, methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $this->comboDetailService->deleteComboDetail($id);

        return $this->json(['message' => 'Combo Detail deleted successfully'], Response::HTTP_NO_CONTENT);
    }
}
