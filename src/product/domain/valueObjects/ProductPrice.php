<?php

namespace app\src\product\domain\valueObjects;

final class ProductPrice{
    private $value;

    /**
     * ProductPrice constructor.
     * @param float $price
    */

    public function __construct(float $price)
    {
        $this->value = $price;
    }

    public function value(): float
    {
        return $this->value;
    }
}