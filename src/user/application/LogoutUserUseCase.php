<?php

namespace app\src\user\application;

use app\src\user\domain\UserRepository;
use app\src\user\domain\valueObjects\UserId;

final class LogoutUserUseCase
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


    public function logoutUser(int $userId)
    {
        $id = new UserId($userId);

        return $this->repository->logoutUser($id);
    }
}