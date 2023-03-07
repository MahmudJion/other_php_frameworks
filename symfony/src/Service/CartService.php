<?php

namespace App\Service;

use App\Entity\Cart;
use App\Entity\Checkout;
use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;

class CartService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function checkout(Cart $cart, Checkout $checkout): Order
    {
        // Create a new order based on the checkout information
        $order = new Order();
        $order->setEmail($checkout->getEmail());
        $order->setFirstName($checkout->getFirstName());
        $order->setLastName($checkout->getLastName());
        $order->setAddress($checkout->getAddress());
        $order->setCountry($checkout->getCountry());
        $order->setCity($checkout->getCity());
        $order->setZipCode($checkout->getZipCode());
        $order->setPaymentMethod($checkout->getPaymentMethod());
        $order->setCreatedAt(new \DateTime());
        $order->setTotal($cart->getTotal());

        // Save the order to the database
        $this->entityManager->persist($order);
        $this->entityManager->flush();

        // Move the cart items to the order
        foreach ($cart->getItems() as $item) {
            $orderItem = new OrderItem();
            $orderItem->setProduct($item->getProduct());
            $orderItem->setQuantity($item->getQuantity());
            $orderItem->setPrice($item->getProduct()->getPrice());
            $orderItem->setOrder($order);
            $this->entityManager->persist($orderItem);
            $this->entityManager->remove($item);
        }

        // Save the changes to the cart and clear the session
        $this->entityManager->flush();
        $cart->setTotal(0);
        $this->entityManager->remove($cart);
        $this->entityManager->flush();

        return $order;
    }
}
