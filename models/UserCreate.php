<?php

namespace app\models;

use yii\base\Model;

class UserCreate extends Model
{
    public $name;
    public $email;
    public $password;

    public function rules()
    {
        return [
            // los atributos name, email, password on obligatorios
            [['name', 'email', 'password'], 'required'],

            // el atributo email debe ser una dirección de email válida
            ['email', 'email'],
            // el email debe ser unico
            ['email', 'isUnique'],
        ];
    }

    /**
     * Validates the email.
     * is email in unique.
     *  @var string $attribute in field request
    */

    public function isUnique($attribute, $params)
    {
        $query = new \yii\db\Query();

        $user = $query->from('users')->where('email=:email', [':email' => $this->email])->count();

        if( $user > 0 ){
            $this->addError($attribute, 'The email has already been taken.');
        }
    }
}