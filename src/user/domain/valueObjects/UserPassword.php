<?php

namespace app\src\user\domain\valueObjects;

final class UserPassword
{
    private $value;

    /**
     * UserPassword constructor.
     * @param int $id
    */

    public function __construct(string $password)
    {
        $this->value = $password;
    }

    public function value(): string
    {
        return $this->value;
    }
}