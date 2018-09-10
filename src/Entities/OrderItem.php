<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class OrderItem
 * @package App\Entities
 * @ORM\Entity()
 * @ORM\Table(name="order_items")
 */
class OrderItem
{
    public function __construct()
    {
        $this->quantity = 1;
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
     * @ORM\ManyToOne(targetEntity="\App\Entities\Product")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    protected $product;

    public function getProduct()
    {
        return $this->product;
    }

    public function setProduct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * @var integer
     * @ORM\Column(type="string", name="quantity")
     */
    protected $quantity;

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @var Order
     * @ORM\ManyToOne(targetEntity="\App\Entities\Order")
     * @ORM\JoinColumn(name="order_id", referencedColumnName="id")
     */
    protected $order;
}
