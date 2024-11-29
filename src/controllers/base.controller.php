<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class BaseController extends AbstractController
{
    protected function successResponse($data, int $statusCode = Response::HTTP_OK): JsonResponse
    {
        return new JsonResponse(['status' => 'success', 'data' => $data], $statusCode);
    }

    protected function errorResponse(string $message, int $statusCode = Response::HTTP_BAD_REQUEST): JsonResponse
    {
        return new JsonResponse(['status' => 'error', 'message' => $message], $statusCode);
    }
}
