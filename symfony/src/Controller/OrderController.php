<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    /**
     * @Route("/order/confirmation/{id}", name="order_confirmation")
     */
    public function confirmation($id)
    {
        // Retrieve the order details from the database
        $order = $this->getDoctrine()->getRepository(Order::class)->find($id);

        // Render the order confirmation page with order details
        return $this->render('order/confirmation.html.twig', [
            'order' => $order,
        ]);
    }

    /**
     * @Route("/order/tracking/{id}", name="order_tracking")
     */
    public function tracking($id)
    {
        // Retrieve the order details from the database
        $order = $this->getDoctrine()->getRepository(Order::class)->find($id);

        // Render the order tracking page with order details
        return $this->render('order/tracking.html.twig', [
            'order' => $order,
        ]);
    }
}
