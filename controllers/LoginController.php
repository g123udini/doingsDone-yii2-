<?php

namespace app\controllers;

use app\models\forms\loginForm;
use app\models\forms\RegistrationForm;
use DoingsDone\exceptions\ModelSaveException;
use Yii;
use yii\web\Controller;

class LoginController extends Controller
{
    function actionIndex() {
        $loginForm = new loginForm();

        if (Yii::$app->request->isPost) {
            $loginForm->load(Yii::$app->request->post());

            if ($loginForm->validate()) {

                Yii::$app->user->login($loginForm->getUser());
                //$this->goHome();
            }
        }

        return $this->render('login', ['model' => $loginForm]);
    }

    function actionRegistration() {
        $registrationForm = new RegistrationForm();

        if (Yii::$app->request->isPost) {
            $registrationForm->load(Yii::$app->request->post());

            if ($registrationForm->validate()) {
                if (!$registrationForm->loadToUser()->save()) {

                    throw new ModelSaveException('Не удалось сохранить юзера');
                }
            }
        }

        return $this->render('registration', ['model' => $registrationForm]);
    }

    function actionStart() {
        $this->layout = 'landing';

        return $this->render('start');
    }

    function actionLogin() {

    }
}