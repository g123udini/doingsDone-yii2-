<?php

namespace app\controllers;

use app\models\forms\AddTaskForm;
use app\models\Project;
use app\models\ProjectTask;
use app\models\Task;
use DoingsDone\exceptions\ModelSaveException;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
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
                $addTaskForm->file = UploadedFile::getInstance($addTaskForm, 'file');

                $addTaskForm->loadToTask();
                $this->redirect(['task/list', 'id' => $addTaskForm->project_id]);
            }
        }

        return $this->render('add', ['model' => $addTaskForm]);
    }

    public function actionList($id)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Task::getQueryTasksByProject($id),
        ]);

        return $this->render('list', ['dataProvider' => $dataProvider]);
    }

    public function actionDownload($id)
    {
        $currentFile = Yii::$app->basePath . '/web/uploads/' . Task::findOne($id)->file;;

        if (!is_file($currentFile)) {
            throw new NotFoundHttpException('Файл не найден');
        }
        Yii::$app->response->sendFile($currentFile)->send();

        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionDelete($id)
    {
        $transaction = Yii::$app->db->beginTransaction();

        if (ProjectTask::findOne(['task_id' => $id])->delete() && Task::findOne($id)->delete()) {
            $transaction->commit();
        } else {
            $transaction->rollBack();
        }

        return $this->redirect(Yii::$app->request->referrer);
    }
}