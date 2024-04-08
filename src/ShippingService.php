<?php

use Skeleton\ShippingServiceInterface;

class ShippingService implements ShippingServiceInterface
{
    public function ship($order, $buyer): string
    {
        $fulfillment = new Fulfillment($order, $buyer);
        $fulfillment->load();

        $api = new ApiService();
        $api->createFulfillmentOrder($fulfillment);

        $result = $api->getFulfillmentOrder($fulfillment['sellerFulfillmentOrderId']);

        if (!isset($result['payload']['fulfillmentShipments'][0]['fulfillmentShipmentPackage'][0]['trackingNumber'])) {
            throw new Exception('Unable to get a tracking number');
        }

        $trackingNumber = $result['payload']['fulfillmentShipments'][0]['fulfillmentShipmentPackage'][0]['trackingNumber'];

        return $trackingNumber;
    }
}