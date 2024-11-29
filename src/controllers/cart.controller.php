<?php

namespace App\Controller;

use App\Dto\CartDto;
use App\Dto\CartUpdateDto;
use App\Service\CartService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class CartController extends BaseController
{
    private CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    #[Route('/carts', name: 'create_cart', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $dto = new CartDto();
        $dto->userId = $data['userId'];
        $dto->flightId = $data['flightId'];
        $dto->hotelId = $data['hotelId'];
        $dto->activityId = $data['activityId'];
        $dto->quantity = $data['quantity'];

        $cart = $this->cartService->createCart($dto);

        return $this->successResponse($cart);
    }

    #[Route('/carts/{id}', name: 'get_cart', methods: ['GET'])]
    public function getById(int $id): JsonResponse
    {
        $cart = $this->cartService->getCartById($id);
        return $cart ? $this->successResponse($cart) : $this->errorResponse('Cart not found', 404);
    }

    #[Route('/carts/{id}', name: 'update_cart', methods: ['PUT'])]
    public function update(int $id, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $dto = new CartUpdateDto();
        $dto->flightId = $data['flightId'] ?? null;
        $dto->hotelId = $data['hotelId'] ?? null;
        $dto->activityId = $data['activityId'] ?? null;
        $dto->quantity = $data['quantity'] ?? null;

        $cart = $this->cartService->getCartById($id);
        if (!$cart) {
            return $this->errorResponse('Cart not found', 404);
        }

        $updatedCart = $this->cartService->updateCart($cart, $dto);

        return $this->successResponse($updatedCart);
    }

    #[Route('/carts/{id}', name: 'delete_cart', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $cart = $this->cartService->getCartById($id);
        if (!$cart) {
            return $this->errorResponse('Cart not found', 404);
        }

        $this->cartService->deleteCart($cart);
        return $this->successResponse(['message' => 'Cart deleted successfully']);
    }
}
