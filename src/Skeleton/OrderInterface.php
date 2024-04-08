<?php

namespace Skeleton;

use ArrayAccess;

/**
 * @property int $order_id
 * @property int $order_unique
 * @property int $site_client_id
 * @property array $data
 * @property array $products
 */
interface OrderInterface extends ArrayAccess
{
}
