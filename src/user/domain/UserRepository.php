<?php

namespace app\src\user\domain;

use app\src\user\domain\valueObjects\UserEmail;
use app\src\user\domain\valueObjects\UserId;
use app\src\user\domain\valueObjects\UserPassword;

interface UserRepository{

    public function save(User $user);

    public function loginUser(UserEmail $email, UserPassword $password);

    public function logoutUser(UserId $id);
}
