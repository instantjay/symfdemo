<?php

namespace App;

use App\Entities\Order;
use App\Entities\OrderItem;
use App\Services\OrderService;
use App\System\Application;

require_once(__DIR__.'/../vendor/autoload.php');

$app = Application::getInstance();

$orderService = $app->getServiceContainer()->get(OrderService::class);

// Fake some data
$order = new Order();
$orderItem = new OrderItem();
$order->addOrderItem($orderItem);

// Call a method in a service that depends on other services (auto-wired). Should output 1.25
echo $orderService->calculateOrderTotal($order, false);