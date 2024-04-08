<?php

use Skeleton\AbstractOrder;
use Skeleton\OrderInterface;

class Order extends AbstractOrder implements OrderInterface
{
    public ?array $data;

    protected function loadOrderData(int $id): array
    {
        $filePath = __DIR__ . "/../mock/order.{$id}.json";

        if (!file_exists($filePath)) {
            throw new Exception("Order {$id} not found");
        }
        
        return json_decode(file_get_contents($filePath), true);
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