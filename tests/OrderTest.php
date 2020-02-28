<?php

namespace App\Tests;

use App\Entities\Order;
use App\Entities\OrderItem;
use App\Entities\Product;
use App\Entities\Project;
use App\Services\FormattingService;
use App\Services\OrderService;
use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{
    /**
     * @var Order $order
     */
    protected $order;

    public function setUp(): void
    {
        // Set up our test data.
        $product = new Product();
        $product->setBasePrice(1);
        $product->setValueAddedTaxRate(1.25);

        $orderItem = new OrderItem();
        $orderItem->setProduct($product);
        $orderItem->setQuantity(1);

        $project = new Project();

        $order = new Order();
        $order->addOrderItem($orderItem);
        $order->setProject($project);

        $this->order = $order;
    }

    public function testOrderReturns(): void
    {
        $this->assertNotEmpty($this->order->getOrderItems());

        /**
         * @var OrderItem[] $items
         */
        $items = $this->order->getOrderItems();

        $this->assertCount(1, $items);

        foreach ($items as $i) {
            $this->assertNotEmpty($i->getQuantity());
            $this->assertNotEmpty($i->getProduct());

            /**
             * @var Product $product
             */
            $product = $i->getProduct();

            $this->assertNotEmpty($product->getBasePrice());
            $this->assertNotEmpty($product->getValueAddedTaxRate());
        }
    }

    public function testCalculateOrderTotal(): void
    {
        $orderService = new OrderService(
            new FormattingService()
        );

        // ASSERT that the order items list is not empty
        $this->assertNotEmpty($this->order->getOrderItems(), 'The order appears to have no items.');

        // CASE: Do not apply project-specific rounding
        $total = $orderService->calculateOrderTotal($this->order, false);
        $this->assertEquals(1.25, $total);

        // CASE: Apply project-specific rounding (uses CEIL() )
        $total = $orderService->calculateOrderTotal($this->order, true);

        // Item costs 1. +25% tax= 1.25, but since the preferred rounding is ceil() and we only want 1 decimal
        // the result we get back Should be 2

        $this->assertEquals(2, $total);
    }
}
