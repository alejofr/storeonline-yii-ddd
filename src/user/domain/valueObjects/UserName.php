<?php

namespace app\src\user\domain\valueObjects;

final class UserName
{
    private $value;

    /**
     * UserNmae constructor.
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