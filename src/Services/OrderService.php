<?php

namespace App\Services;

use App\Entities\Order;

class OrderService
{
    protected $emailService;
    protected $formattingService;

    /**
     * OrderService constructor.
     * @param EmailService $emailService
     * @param FormattingService $formattingService
     */
    public function __construct(EmailService $emailService, FormattingService $formattingService)
    {
        $this->emailService = $emailService;
        $this->formattingService = $formattingService;
    }

    /**
     * @param Order $order
     * @param bool $applyProjectRounding
     * @return double
     */
    public function calculateOrderTotal(Order $order, $applyProjectRounding = true)
    {
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
