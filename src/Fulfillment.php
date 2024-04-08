<?php

use Skeleton\AbstractFulfillment;
use Skeleton\FulfillmentInterface;

class Fulfillment extends AbstractFulfillment implements FulfillmentInterface
{
    const SHIPPING_TYPES = [
        1 => 'Standard',
        2 => 'Expedited',
        3 => 'Priority',
        7 => 'ScheduledDelivery',
    ];

    public ?array $data;

    protected function loadFulfillmentData($order, $buyer): array
    {
        $items = [];

        foreach ($order['products'] as $product) {
            $items[] = [
                'sellerSku' => $product['sku'],
                'sellerFulfillmentOrderItemId' => $product['order_product_id'],
                'quantity' => (int) $product['ammount'],
            ];
        }

        return [
            'displayableOrderId' => $order->getOrderId(),
            'sellerFulfillmentOrderId' => $order['order_unique'],
            'displayableOrderDate' => $order['order_date'],
            'displayableOrderComment' => $order['comments'],
            'shippingSpeedCategory' => self::SHIPPING_TYPES[$order['shipping_type_id']],
            'fulfillmentAction' => 'Ship',
            'notificationEmails' => [
                $buyer['email'],
            ],
            'destinationAddress' => [
                'name' => $order['buyer_name'],
                'addressLine1' => $order['shipping_street'],
                'city' => $order['shipping_city'],
                'stateOrRegion' => $order['shipping_state'],
                'postalCode' => $order['shipping_zip'],
                'countryCode' => $order['shipping_country'],
                'phone' => $buyer['phone'],
            ],
            'items' => $items,
        ];
    }

    public function offsetSet($offset, $value): void {
        if (is_null($offset)) {
            $this->data[] = $value;
        } else {
            $this->data[$offset] = $value;
        }
    }

    public function offsetExists($offset): bool {
        return isset($this->data[$offset]);
    }

    public function offsetUnset($offset): void {
        unset($this->data[$offset]);
    }

    public function offsetGet($offset): mixed {
        return isset($this->data[$offset]) ? $this->data[$offset] : null;
    }
}