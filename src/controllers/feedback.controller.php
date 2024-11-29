<?php

namespace App\Controller;

use App\Dto\FeedbackDto;
use App\Dto\FeedbackUpdateDto;
use App\Service\FeedbackService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class FeedbackController extends BaseController
{
    private FeedbackService $feedbackService;

    public function __construct(FeedbackService $feedbackService)
    {
        $this->feedbackService = $feedbackService;
    }

    #[Route('/feedbacks', name: 'create_feedback', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $dto = new FeedbackDto();
        $dto->userId = $data['userId'];
        $dto->relatedType = $data['relatedType'];
        $dto->relatedId = $data['relatedId'];
        $dto->rating = $data['rating'];
        $dto->comment = $data['comment'];

        $feedback = $this->feedbackService->createFeedback($dto);

        return $this->successResponse($feedback);
    }

    #[Route('/feedbacks/{id}', name: 'get_feedback', methods: ['GET'])]
    public function getById(int $id): JsonResponse
    {
        $feedback = $this->feedbackService->getFeedbackById($id);
        return $feedback ? $this->successResponse($feedback) : $this->errorResponse('Feedback not found', 404);
    }

    #[Route('/feedbacks/{id}', name: 'update_feedback', methods: ['PUT'])]
    public function update(int $id, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $dto = new FeedbackUpdateDto();
        $dto->rating = $data['rating'] ?? null;
        $dto->comment = $data['comment'] ?? null;

        $feedback = $this->feedbackService->getFeedbackById($id);
        if (!$feedback) {
            return $this->errorResponse('Feedback not found', 404);
        }

        $updatedFeedback = $this->feedbackService->updateFeedback($feedback, $dto);

        return $this->successResponse($updatedFeedback);
    }

    #[Route('/feedbacks/{id}', name: 'delete_feedback', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $feedback = $this->feedbackService->getFeedbackById($id);
        if (!$feedback) {
            return $this->errorResponse('Feedback not found', 404);
        }

        $this->feedbackService->deleteFeedback($feedback);
        return $this->successResponse(['message' => 'Feedback deleted successfully']);
    }
}
