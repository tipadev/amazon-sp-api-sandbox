<?php

namespace Skeleton;

interface ShippingServiceInterface
{
    public function ship(AbstractOrder $order, BuyerInterface $buyer): string;
}
