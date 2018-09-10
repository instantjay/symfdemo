<?php

namespace App\Services;

use App\Entities\Order;
use App\Entities\OrderItem;

class OrderService
{
    protected $formattingService;

    /**
     * OrderService constructor.
     * @param FormattingService $formattingService
     */
    public function __construct(FormattingService $formattingService)
    {
        $this->formattingService = $formattingService;
    }

    /**
     * @param Order $order
     * @param bool $applyProjectRounding
     * @return double
     */
    public function calculateOrderTotal(Order $order, $applyProjectRounding = true)
    {
        /**
         * @var OrderItem[] $items
         */
        $items = $order->getOrderItems();

        $total = 0;

        foreach ($items as $i) {
            $product = $i->getProduct();

            $total += ( $product->getBasePrice() * $i->getQuantity() ) * $product->getValueAddedTaxRate();
        }

        if ($applyProjectRounding) {
            $total = $this->formattingService->roundValueBasedOnProject($total, $order->getProject());
        }

        return $total;
    }
}
