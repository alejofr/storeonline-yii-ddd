<?php

namespace app\src\user\domain\valueObjects;

final class UserId
{
    private $value;

    /**
     * UserId constructor.
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