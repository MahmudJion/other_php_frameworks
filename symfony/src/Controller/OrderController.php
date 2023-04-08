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
}
