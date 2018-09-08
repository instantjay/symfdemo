<?php

namespace App\Entities;

class Order
{
    protected $orderItems;

    /**
     * @return OrderItem[]
     */
    public function getOrderItems()
    {
        return $this->orderItems;
    }

    /**
     * @param OrderItem $item
     */
    public function addOrderItem(OrderItem $item)
    {
        $this->orderItems[] = $item;
    }

    /**
     * @return Project
     */
    public function getProject()
    {
        return new Project();
    }
}
