<?php

namespace App\Entities;

class Product
{
    /**
     * return double
     */
    public function getBasePrice()
    {
        return 1;
    }

    /**
     * @return double
     */
    public function getValueAddedTaxRate()
    {
        return 1.25;
    }
}
