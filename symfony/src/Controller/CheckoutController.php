<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\Checkout;
use App\Entity\Order;
use App\Form\CheckoutType;
use App\Service\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CheckoutController extends AbstractController
{
    /**
     * @Route("/checkout", name="checkout")
     */
    public function checkout(Request $request, CartService $cartService)
    {
        $checkout = new Checkout();

        $form = $this->createForm(CheckoutType::class, $checkout);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Process the payment and complete the order
            $cart = $cartService->getCart();
            $order = $cartService->checkout($cart, $checkout);

            return $this->redirectToRoute('order_confirmation', [
                'orderId' => $order->getId(),
            ]);
        }

        return $this->render('checkout.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
