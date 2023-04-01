<?php

namespace app\models;

use yii\base\Model;

class UserLogin extends Model
{
    public $email;
    public $password;

    public function rules()
    {
        return [
            // los atributos email, password on obligatorios
            [['email', 'password'], 'required'],

            // el atributo email debe ser una dirección de email válida
            ['email', 'email'],
        ];
    }
}