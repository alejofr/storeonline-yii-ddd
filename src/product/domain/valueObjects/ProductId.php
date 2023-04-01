<?php

namespace app\src\product\domain\valueObjects;

final class ProductId
{
    private $value;

    /**
     * ProductId constructor.
     * @param int $id
    */

    public function __construct(int $id)
    {
        $this->value = $id;
    }

    public function value(): int
    {
        return $this->value;
    }

}