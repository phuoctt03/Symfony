<?php

namespace App\Controller;

use App\DTO\Request\Activity\CreateActivityDTO;
use App\DTO\Request\Activity\UpdateActivityDTO;
use App\DTO\Response\Activity\ActivityResponseDTO;
use App\Service\ActivityService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ActivityController extends AbstractController
{
    public function __construct(private ActivityService $activityService) {}

    #[Route('/activities', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $dto = new CreateActivityDTO($data);
        $activity = $this->activityService->createActivity($dto);

        return $this->json(new ActivityResponseDTO($activity), Response::HTTP_CREATED);
    }

    private const ACTIVITY_ROUTE = '/activities/{id}';

    #[Route(self::ACTIVITY_ROUTE, methods: ['GET'])]
    public function read(int $id): JsonResponse
    {
        $activity = $this->activityService->getActivityById($id);

        if (!$activity) {
            return $this->json(['message' => 'Activity not found'], Response::HTTP_NOT_FOUND);
        }

        return $this->json(new ActivityResponseDTO($activity));
    }

    #[Route(self::ACTIVITY_ROUTE, methods: ['PUT'])]
    public function update(int $id, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $dto = new UpdateActivityDTO($data);
        $dto->id = $id;

        $activity = $this->activityService->updateActivity($dto);

        return $this->json(new ActivityResponseDTO($activity));
    }

    #[Route(self::ACTIVITY_ROUTE, methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $this->activityService->deleteActivity($id);

        return $this->json(['message' => 'Activity deleted successfully'], Response::HTTP_NO_CONTENT);
    }
}
