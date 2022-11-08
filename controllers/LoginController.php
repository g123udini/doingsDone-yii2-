<?php

namespace app\controllers;

use yii\web\Controller;

class LoginController extends Controller
{
    function actionIndex() {
        $this->layout = 'layout';

        return $this->render('start');
    }

}