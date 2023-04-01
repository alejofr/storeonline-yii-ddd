<?php

namespace app\src\user\infrastructure\repositories;

use app\src\user\domain\User;
use app\src\user\domain\UserRepository;
use app\src\user\domain\valueObjects\UserEmail;
use app\src\user\domain\valueObjects\UserId;
use app\src\user\domain\valueObjects\UserName;
use app\src\user\domain\valueObjects\UserPassword;
use app\src\user\infrastructure\model\User as ActiveRecordUserModel;
use Yii;

final class RecordPatternUser implements UserRepository
{
    private $activeRecordUserModel;

    /**
     * User model injection.
     * @param User
    */


    public function __construct()
    {
        $this->activeRecordUserModel = new ActiveRecordUserModel();
    }


    public function save(User $user)
    {
        $newUser = $this->activeRecordUserModel;

        $newUser->name = $user->name()->value();
        $newUser->email = $user->email()->value();
        $newUser->password = Yii::$app->getSecurity()->generatePasswordHash($user->password()->value());

        if( $newUser->save(false) )
            return $newUser;

    }


    public function loginUser(UserEmail $email, UserPassword $password)
    {
        $user =  $this->activeRecordUserModel->findOne(['email' => $email->value()]);

        if( $user != null ){
            if (Yii::$app->getSecurity()->validatePassword($password->value(), $user->password)) {

                $user->access_token = Yii::$app->security->generateRandomString();
                $user->save();
    
                return $user;
                
            } 
        }

        return null;
    }

    public function logoutUser(UserId $id) {
        $user = $this->activeRecordUserModel->findOne(['id' => $id->value()]);

        if( $user != null ){
            $user->access_token = null;
            $user->save();
        }

        return null;
    }

}