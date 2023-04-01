<?php

namespace app\src\product\domain\valueObjects;

final class ProductDescription{
    private $value;

    /**
     * ProductDescription constructor.
     * @param string $description
    */

    public function __construct(string $description)
    {
        $this->value = $description;
    }

    public function value(): string
    {
        return $this->value;
    }
}