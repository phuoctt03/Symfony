<?php

namespace App\Controller;

use App\Dto\ActivityDto;
use App\Dto\ActivityUpdateDto;
use App\Service\ActivityService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class ActivityController extends BaseController
{
    private ActivityService $activityService;

    public function __construct(ActivityService $activityService)
    {
        $this->activityService = $activityService;
    }

    #[Route('/activities', name: 'create_activity', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $dto = new ActivityDto();
        $dto->name = $data['name'];
        $dto->price = $data['price'];
        $dto->description = $data['description'];

        $activity = $this->activityService->createActivity($dto);

        return $this->successResponse($activity);
    }

    #[Route('/activities/{id}', name: 'get_activity', methods: ['GET'])]
    public function getById(int $id): JsonResponse
    {
        $activity = $this->activityService->getActivityById($id);
        return $activity ? $this->successResponse($activity) : $this->errorResponse('Activity not found', 404);
    }

    #[Route('/activities/{id}', name: 'update_activity', methods: ['PUT'])]
    public function update(int $id, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $dto = new ActivityUpdateDto();
        $dto->name = $data['name'] ?? null;
        $dto->price = $data['price'] ?? null;
        $dto->description = $data['description'] ?? null;

        $activity = $this->activityService->getActivityById($id);
        if (!$activity) {
            return $this->errorResponse('Activity not found', 404);
        }

        $updatedActivity = $this->activityService->updateActivity($activity, $dto);

        return $this->successResponse($updatedActivity);
    }

    #[Route('/activities/{id}', name: 'delete_activity', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $activity = $this->activityService->getActivityById($id);
        if (!$activity) {
            return $this->errorResponse('Activity not found', 404);
        }

        $this->activityService->deleteActivity($activity);
        return $this->successResponse(['message' => 'Activity deleted successfully']);
    }
}
