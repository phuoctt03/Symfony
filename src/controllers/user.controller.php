<?php

namespace App\Controller;

use App\Dto\UserDto;
use App\Dto\UserUpdateDto;
use App\Service\UserService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserController extends BaseController
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    #[Route('/users', name: 'create_user', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $dto = new UserDto();
        $dto->username = $data['username'];
        $dto->password = $data['password'];
        $dto->email = $data['email'];
        $dto->phone = $data['phone'];
        $dto->role = $data['role'];
        $dto->promoId = $data['promoId'] ?? null;

        $user = $this->userService->createUser($dto);

        return $this->successResponse($user);
    }

    #[Route('/users/{id}', name: 'get_user', methods: ['GET'])]
    public function getById(int $id): JsonResponse
    {
        $user = $this->userService->getUserById($id);
        return $user ? $this->successResponse($user) : $this->errorResponse('User not found', 404);
    }

    #[Route('/users/{id}', name: 'update_user', methods: ['PUT'])]
    public function update(int $id, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $dto = new UserUpdateDto();
        $dto->username = $data['username'] ?? null;
        $dto->email = $data['email'] ?? null;
        $dto->phone = $data['phone'] ?? null;
        $dto->role = $data['role'] ?? null;
        $dto->promoId = $data['promoId'] ?? null;

        $user = $this->userService->getUserById($id);
        if (!$user) {
            return $this->errorResponse('User not found', 404);
        }

        $updatedUser = $this->userService->updateUser($user, $dto);

        return $this->successResponse($updatedUser);
    }

    #[Route('/users/{id}', name: 'delete_user', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $user = $this->userService->getUserById($id);
        if (!$user) {
            return $this->errorResponse('User not found', 404);
        }

        $this->userService->deleteUser($user);
        return $this->successResponse(['message' => 'User deleted successfully']);
    }
}
