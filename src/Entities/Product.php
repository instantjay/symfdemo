<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Product
 * @package App\Entities
 * @ORM\Entity()
 * @ORM\Table(name="products")
 */
class Product
{
    public function __construct()
    {
        $this->setValueAddedTaxRate(1.0); // Is this a good default?
    }

    /**
     * @var string
     * @ORM\Column(type="string", name="id")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="UUID")
     */
    protected $id;

    public function getId()
    {
        return $this->id;
    }

    /**
     * @var double
     * @ORM\Column(type="double", name="base_price")
     */
    protected $basePrice;

    public function getBasePrice()
    {
        return $this->basePrice;
    }

    public function setBasePrice($basePrice)
    {
        $this->basePrice = $basePrice;
    }

    /**
     * @var double
     * @ORM\Column(type="double", name="value_added_tax_rate")
     */
    protected $valueAddedTaxRate;

    public function getValueAddedTaxRate()
    {
        return $this->valueAddedTaxRate;
    }

    public function setValueAddedTaxRate($rate)
    {
        $this->valueAddedTaxRate = $rate;
    }
}
