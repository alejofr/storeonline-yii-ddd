<?php

namespace app\src\product\domain\valueObjects;

final class ProductName{
    private $value;

    /**
     * ProductName constructor.
     * @param string $name
    */

    public function __construct(string $name)
    {
        $this->value = $name;
    }

    public function value(): string
    {
        return $this->value;
    }
}