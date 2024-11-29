<?php

namespace App\Service;

use App\Entity\Cart;
use App\Dto\CartDto;
use App\Dto\CartUpdateDto;
use Doctrine\ORM\EntityManagerInterface;

class CartService extends BaseService
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager);
    }

    public function createCart(CartDto $dto): Cart
    {
        $cart = new Cart();
        $cart->setUserId($dto->userId);
        $cart->setFlightId($dto->flightId);
        $cart->setHotelId($dto->hotelId);
        $cart->setActivityId($dto->activityId);
        $cart->setQuantity($dto->quantity);
        $cart->setCreatedDate($dto->createdDate);

        $this->saveEntity($cart);

        return $cart;
    }

    public function updateCart(Cart $cart, CartUpdateDto $dto): Cart
    {
        if ($dto->flightId !== null) $cart->setFlightId($dto->flightId);
        if ($dto->hotelId !== null) $cart->setHotelId($dto->hotelId);
        if ($dto->activityId !== null) $cart->setActivityId($dto->activityId);
        if ($dto->quantity !== null) $cart->setQuantity($dto->quantity);

        $this->saveEntity($cart);

        return $cart;
    }

    public function getCartById(int $id): ?Cart
    {
        return $this->entityManager->getRepository(Cart::class)->find($id);
    }

    public function deleteCart(Cart $cart): void
    {
        $this->deleteEntity($cart);
    }
}
