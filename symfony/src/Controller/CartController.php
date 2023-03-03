<?php

namespace App\Controller;

use App\Entity\Product;
use App\Service\Cart;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/cart/add/{id}", name="cart_add", methods={"POST"})
     */
    public function add(Request $request, Product $product, Cart $cart): Response
    {
        $quantity = $request->request->get('quantity', 1);
        $cart->addProduct($product, $quantity);

        $this->addFlash('success', sprintf('%d x %s added to cart', $quantity, $product->getName()));

        return $this->redirectToRoute('product_details', ['id' => $product->getId()]);
    }
}
