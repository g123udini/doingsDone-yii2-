<?php

namespace app\models\forms;

use app\models\User;
use yii\base\Model;

class loginForm extends Model
{
    public $email;
    public $password;

    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
            [['email'], 'email'],
            [['password'], 'validatePassword']
        ];
    }

    public function attributeLabels()
    {
        return [
            'email' => 'Email',
            'password' => 'Пароль'
        ];
    }

    public function getUser()
    {
        return User::findOne(['email' => $this->email]);
    }

    public function validatePassword($attribute)
    {
        $user = $this->getUser();
        if (!$user || !$user->validatePassword($this->password)) {
            $this->addError($attribute, 'Неправильный email или пароль');
        }
    }
}