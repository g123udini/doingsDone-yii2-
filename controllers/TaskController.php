<?php

namespace app\controllers;

use app\models\Project;
use Yii;
use yii\web\Controller;

class TaskController extends Controller
{
    public function actionIndex()
    {
        $projectModel = new Project();
        $projectModel->user_id = Yii::$app->user->id;

        if (Yii::$app->request->isPost) {
            $projectModel->load(Yii::$app->request->post());

            if ($projectModel->validate()) {

                $projectModel->save();
            }
        }

        return $this->render('project', ['model' => $projectModel]);
    }
}