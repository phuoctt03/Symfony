<?php

namespace App\Controller;

use App\DTO\Request\User\CreateUserDTO;
use App\DTO\Request\User\UpdateUserDTO;
use App\DTO\Response\User\UserResponseDTO;
use App\Entity\User;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use OpenApi\Attributes as OA;

class UserController extends AbstractController
{
    public function __construct(private UserService $userService) {}

    #[OA\Post(
        summary: "Create a new user",
        requestBody: new OA\RequestBody(
            content: new OA\JsonContent(ref: "#/components/schemas/CreateUserDTO")
        ),
        responses: [
            new OA\Response(response: 201, description: "User created successfully"),
            new OA\Response(response: 400, description: "Validation error")
        ]
    )]
    #[Route('/users', methods: ['POST'])]
    public function createUser(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $dto = new CreateUserDTO($data);

        $user = $this->userService->createUser($dto);
        return $this->json(new UserResponseDTO($user), Response::HTTP_CREATED);
    }

    private const USER_ROUTE = '/users/{id}';

    #[Route(self::USER_ROUTE, methods: ['GET'])]
    public function getUser(int $id): JsonResponse
    {
        $user = $this->userService->getUserById($id);

        if (!$user) {
            return $this->json(['message' => 'User not found'], Response::HTTP_NOT_FOUND);
        }

        return $this->json(new UserResponseDTO($user));
    }

    #[Route(self::USER_ROUTE, methods: ['PATCH'])]
    public function updateUser(int $id, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $dto = new UpdateUserDTO($data);
        $dto->id = $id;

        $user = $this->userService->updateUser($dto);

        return $this->json(new UserResponseDTO($user));
    }

    #[Route(self::USER_ROUTE, methods: ['DELETE'])]
    #[IsGranted('ROLE_ADMIN')]
    public function deleteUser(int $id): JsonResponse
    {
        $this->userService->deleteUser($id);

        return $this->json(['message' => 'User deleted successfully'], Response::HTTP_NO_CONTENT);
    }
}
