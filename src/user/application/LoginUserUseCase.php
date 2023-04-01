<?php

namespace app\src\user\application;

use app\src\user\domain\UserRepository;
use app\src\user\domain\valueObjects\UserEmail;
use app\src\user\domain\valueObjects\UserPassword;

final class LoginUserUseCase
{
    private $repository;

    /**
     * Repository injection.
     * @param UserRepository
    */

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Login User.
     * @param string $userEmail, string $userPassword
    */

    public function loginUser (string $userEmail, string $userPassword)
    {
        $email = new UserEmail($userEmail);
        $password = new UserPassword($userPassword);

        return $this->repository->loginUser($email, $password);
    }
}