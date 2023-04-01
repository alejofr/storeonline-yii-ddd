<?php

namespace app\src\user\application;

use app\src\user\domain\User;
use app\src\user\domain\UserRepository;
use app\src\user\domain\valueObjects\UserEmail;
use app\src\user\domain\valueObjects\UserName;
use app\src\user\domain\valueObjects\UserPassword;

final class CreateUserUseCase
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
     * Create User.
     * @param string $userName, string $userEmail, string $userPassword
     * @return User created
    */

    public function registerUser(string $userName, string $userEmail, string $userPassword)
    {
        $name = new UserName($userName);
        $email = new UserEmail($userEmail);
        $password = new UserPassword($userPassword);
        $user = User::create($name, $email, $password);

        return $this->repository->save($user);
    }
}