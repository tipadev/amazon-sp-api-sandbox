<?php

namespace Skeleton;

abstract class AbstractBuyer
{
    private int $id;
    public ?array $data;

    abstract protected function loadBuyerData(int $id): array;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    final public function getBuyerId(): int
    {
        return $this->id;
    }

    final public function load(): void
    {
        $this->data = $this->loadBuyerData($this->getBuyerId());
    }
}
