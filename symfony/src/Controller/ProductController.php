<?php

use App\Entity\Product;
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="app_product")
     * @Route("/products", name="product_listings")
     * @Route("/products/{id}", name="product_details")
     */
    public function index(): Response
    {
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);


        $products = $this->getDoctrine()
            ->getRepository(Product::class)
            ->findAll();

        return $this->render('product/listings.html.twig', [
            'products' => $products,
        ]);

    }

    public function details(Product $product)
    {
        // $product will contain the correct Product entity based on the 'id' parameter
        // that was passed in the URL

        // render the 'details.html.twig' template with the product entity
        return $this->render('product/details.html.twig', [
            'product' => $product,
        ]);
    }

}
