<?php

namespace App\Tests;

use App\Entities\Order;
use App\Entities\OrderItem;
use App\Services\EmailService;
use App\Services\FormattingService;
use App\Services\OrderService;
use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{
    public function testCalculateOrderTotal()
    {
        $orderService = new OrderService(
            new EmailService(),
            new FormattingService()
        );

        $order = new Order();
        $orderItem = new OrderItem();
        $order->addOrderItem($orderItem);

        // CASE: Do not apply project-specific rounding
        $total = $orderService->calculateOrderTotal($order, false);
        $this->assertEquals(1.25, $total);

        // CASE: Apply project-specific rounding (uses CEIL() )
        $total = $orderService->calculateOrderTotal($order, true);

        // Item costs 1. +25% tax= 1.25, but since the preferred rounding is ceil() and we only want 1 decimal
        // the result we get back Should be 2

        $this->assertEquals(2, $total);
    }
}