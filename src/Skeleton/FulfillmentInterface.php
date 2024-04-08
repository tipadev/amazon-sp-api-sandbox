<?php

namespace Skeleton;

use ArrayAccess;

/**
 * @property int $displayableOrderId
 * @property int $sellerFulfillmentOrderId
 * @property string $displayableOrderComment
 * @property string $displayableOrderDate
 * @property string $shippingSpeedCategory
 * @property string $fulfillmentAction
 * @property array $notificationEmails
 * @property array $destinationAddress
 * @property array $items
 */
interface FulfillmentInterface extends ArrayAccess
{
}
