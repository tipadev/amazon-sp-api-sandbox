<?php

require_once(__DIR__ . '/autoload.php');

if (!isset($argv[1])) {
    throw new Exception('Order ID expected as argument');
}

$orderId = intval($argv[1]);
$order = new Order($orderId);
$order->load();

$buyerId = intval($order['client_id']);
$buyer = new Buyer($buyerId);
$buyer->load();

$shippingService = new ShippingService();
$trackingNumber = $shippingService->ship($order, $buyer);

echo('Tracking number for the order ' . $orderId . ': ' . $trackingNumber . PHP_EOL);