<?php

namespace Skeleton;

interface ApiServiceInterface
{
    public function createFulfillmentOrder(AbstractFulfillment $fulfillment): void;

    public function getFulfillmentOrder(string $fulfillmentOrderId): array;
}
