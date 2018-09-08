<?php

namespace App\Entities;

class OrderItem
{
    /**
     * @return Product
     */
    public function getProduct()
    {
        return new Product();
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return 1;
    }
}
