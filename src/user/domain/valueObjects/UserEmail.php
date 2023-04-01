<?php

namespace app\src\user\domain\valueObjects;

final class UserEmail{
    private $value;

    /**
     * UserEmail constructor.
     * @param string $email
    */

    public function __construct(string $email)
    {
        $this->value = $email;
    }

    public function value(): string
    {
        return $this->value;
    }
}