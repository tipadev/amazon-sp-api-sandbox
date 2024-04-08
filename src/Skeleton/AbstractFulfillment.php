<?php

namespace Skeleton;

abstract class AbstractFulfillment
{
    private AbstractOrder $order;
    private AbstractBuyer $buyer;
    
    public ?array $data;

    abstract protected function loadFulfillmentData(
        AbstractOrder $order, 
        AbstractBuyer $buyer
    ): array;

    public function __construct(AbstractOrder $order, AbstractBuyer $buyer)
    {
        $this->order = $order;
        $this->buyer = $buyer;
    }

    final public function getOrder(): AbstractOrder
    {
        return $this->order;
    }

    final public function getBuyer(): AbstractBuyer
    {
        return $this->buyer;
    }

    final public function load(): void
    {
        $this->data = $this->loadFulfillmentData($this->getOrder(), $this->getBuyer());
    }
}
