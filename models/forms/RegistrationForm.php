<?php
namespace app\models\forms;

use app\models\User;
use DoingsDone\exceptions\ModelSaveException;
use Yii;
use yii\base\Model;

class RegistrationForm extends Model
{
    public $email;
    public $login;
    public $password;
    public $passwordRepeat;

    public function rules()
    {
        return [
            [['email', 'password', 'passwordRepeat', 'login'], 'required'],
            [['email'], 'email'],
            [['login'], 'string'],
            [['password'], 'compare', 'compareAttribute' => 'passwordRepeat'],
            [['email'], 'unique', 'targetClass' => User::className(), 'targetAttribute' => ['email' => 'email']]
        ];
    }

    public function attributeLabels()
    {
        return [
            'email' => 'Email',
            'login' => 'Имя',
            'password' => 'Пароль',
            'passwordRepeat' => 'Повтор пароля'
        ];
    }

    public function loadToUser()
    {
        $user = new User();
        $user->email = $this->email;
        $user->login = $this->login;
        $user->password = Yii::$app->security->generatePasswordHash($this->password);

        return $user;
    }
}