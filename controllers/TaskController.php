<?php

namespace app\controllers;

use app\models\forms\AddTaskForm;
use app\models\Project;
use DoingsDone\exceptions\ModelSaveException;
use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;

class TaskController extends Controller
{
    public function actionIndex()
    {
        $projectModel = new Project();
        $projectModel->user_id = Yii::$app->user->id;

        if (Yii::$app->request->isPost) {
            $projectModel->load(Yii::$app->request->post());

            if ($projectModel->validate()) {

                if (!$projectModel->save()) {
                    throw new ModelSaveException('Не удалось сохранить проект');
                };
            }
        }

        return $this->render('project', ['model' => $projectModel]);
    }

    public function actionAdd()
    {
        $addTaskForm = new AddTaskForm();
        $addTaskForm->userId = Yii::$app->user->id;

        if (Yii::$app->request->isPost) {
            $addTaskForm->load(Yii::$app->request->post());

            if ($addTaskForm->validate()) {
                $addTaskForm->files = UploadedFile::getInstances($addTaskForm, 'files');

                $addTaskForm->loadToTask();
            }
        }

        return $this->render('add', ['model' => $addTaskForm]);
    }

    public function actionList($id)
    {
        return $this->render('list');
    }
}