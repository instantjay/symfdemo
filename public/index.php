<?php

namespace App;

use App\Services\EntityService;
use App\System\Application;

require_once(__DIR__.'/../vendor/autoload.php');

$app = Application::getInstance();

$desiredOrderId = 1;

// Getting an order using the EntityManager
$entityService = $app->getServiceContainer()->get(EntityService::class);
$em = $entityService->getEntityManager();

$orderRepository = $em->getRepository(\App\Entities\Order::class);
/**
 * @var \App\Entities\Order $order
 */
$order = $orderRepository->find($desiredOrderId);

$order->getId(); // Should return 1;

$order->getProject(); // This will work

unset($order);

// Getting an order using NPS' models
$orderModel = new \App\Nosh\Models\OrderModel($app->getServiceContainer());

$dataArray = $orderModel->find($desiredOrderId);

$noshOrder = new \App\Nosh\Order();
$noshOrder->load($dataArray);

$noshOrder->getId(); // Should return 1;

$noshOrder->getProject(); // This will NOT work.