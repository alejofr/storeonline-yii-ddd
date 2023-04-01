<?php

namespace app\src\user\domain;

use app\src\user\domain\valueObjects\UserEmail;
use app\src\user\domain\valueObjects\UserId;
use app\src\user\domain\valueObjects\UserName;
use app\src\user\domain\valueObjects\UserPassword;

final class User
{
    private $name;
    private $email;
    private $password;

    /**
     * User constructor.
     * @param string $email, $name and $password
    */


    public function __construct(UserName $name, UserEmail $email, UserPassword $password)
    {
        $this->name              = $name;
        $this->email             = $email;
        $this->password          = $password;
    }


    public function name(): UserName
    {
        return $this->name;
    }

    
    public function email(): UserEmail
    {
        return $this->email;
    }


    public function password(): UserPassword
    {
        return $this->password;
    }

    /**
     * User create object.
     * @return object $user
    */

    public static function create( UserName $name, UserEmail $email, UserPassword $password ): User
    {
        $user = new self($name, $email, $password);

        return $user;
    }
}