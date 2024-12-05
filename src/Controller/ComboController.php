<?php

namespace App\Controller;

use App\DTO\Request\Combo\CreateComboDTO;
use App\DTO\Request\Combo\UpdateComboDTO;
use App\DTO\Response\Combo\ComboResponseDTO;
use App\Service\ComboService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ComboController extends AbstractController
{
    private const COMBO_ROUTE = '/combos/{id}';
    public function __construct(private ComboService $comboService) {}

    #[Route('/combos', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $dto = new CreateComboDTO($data);
        $combo = $this->comboService->createCombo($dto);

        return $this->json(new ComboResponseDTO($combo), Response::HTTP_CREATED);
    }
    #[Route(self::COMBO_ROUTE, methods: ['GET'])]
    public function read(int $id): JsonResponse
    {
        $combo = $this->comboService->getComboById($id);

        if (!$combo) {
            return $this->json(['message' => 'Combo not found'], Response::HTTP_NOT_FOUND);
        }

        return $this->json(new ComboResponseDTO($combo));
    }
    #[Route(self::COMBO_ROUTE, methods: ['PUT'])]
    public function update(int $id, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $dto = new UpdateComboDTO($data);
        $dto->id = $id;

        $combo = $this->comboService->updateCombo($dto);

        return $this->json(new ComboResponseDTO($combo));
    }
    #[Route(self::COMBO_ROUTE, methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $this->comboService->deleteCombo($id);

        return $this->json(['message' => 'Combo deleted successfully'], Response::HTTP_NO_CONTENT);
    }
}
