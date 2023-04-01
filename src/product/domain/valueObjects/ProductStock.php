<?php

namespace app\src\product\domain\valueObjects;

final class ProductStock{
    private $value;

    /**
     * ProductStock constructor.
     * @param int $stock
    */

    public function __construct(int $stock)
    {
        $this->value = $stock;
    }

    public function value(): int
    {
        return $this->value;
    }
}