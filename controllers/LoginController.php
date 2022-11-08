<?php

namespace app\controllers;

use app\models\forms\RegistrationForm;
use DoingsDone\exceptions\ModelSaveException;
use Yii;
use yii\web\Controller;

class LoginController extends Controller
{
    function actionIndex() {
        $this->layout = 'landing';

        return $this->render('start');
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
}