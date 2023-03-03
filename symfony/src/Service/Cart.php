<?php

namespace App\Service;

use App\Entity\Product;

class Cart
{
    private $items = [];

    public function addProduct(Product $product, int $quantity = 1): void
    {
        if (array_key_exists($product->getId(), $this->items)) {
            $this->items[$product->getId()] += $quantity;
        } else {
            $this->items[$product->getId()] = $quantity;
        }
    }

    public function removeProduct(Product $product): void
    {
        unset($this->items[$product->getId()]);
    }

    public function getItems(): array
    {
        return $this->items;
    }
}
