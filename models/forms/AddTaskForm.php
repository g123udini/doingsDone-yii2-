<?php

namespace app\models\forms;

use app\models\Project;
use app\models\ProjectTask;
use app\models\Task;
use DoingsDone\exceptions\ModelSaveException;
use Yii;
use yii\base\Model;
use yii\db\Exception;

class AddTaskForm extends Model
{
    public $name;
    public $userId;
    public $project_id;
    public $deadline;
    public $file;
    public $filePath;

    public function rules()
    {
        return [
            [['name'], 'string'],
            [['name', 'userId'], 'required'],
            [['file'], 'file'],
            [['deadline'], 'date', 'format' => 'php:Y-m-d'],
            [['project_id'], 'exist', 'targetClass' => Project::class, 'targetAttribute' => ['project_id' => 'id']]
        ];
    }

    public function attributeLabels()
    {
        return [
        'name' => 'Название',
        'deadline' => 'Дата выполнения',
        'project_id' => 'Проект',
        ];
    }

    public function loadToTask()
    {
        $task = new Task();
        $task->name = $this->name;
        $task->user_id = $this->userId;
        $task->deadline = $this->deadline;

        if ($this->uploadFile()) {
            $task->file = $this->filePath;
        }

        $transaction = Yii::$app->db->beginTransaction();

        try {
            if (!$task->save()) {
                throw new ModelSaveException('Не удалось сохранить задание');
            }
            if (!$this->saveProjectTask($task)) {
                throw new ModelSaveException('Не удалось сохранить связь между заданием и проектом');
            }
            $transaction->commit();
        } catch (Exception $exception) {
            $transaction->rollBack();
            throw new ModelSaveException($exception->getMessage());
        }
    }

    private function saveProjectTask($task)
    {
        $taskProject = new ProjectTask();
        $taskProject->project_id = $this->project_id;
        $taskProject->task_id = $task->id;

        return $taskProject->save();
    }

    private function uploadFile()
    {
        if ($this->file && $this->validate()) {
                $newName = uniqid('uploads') . '.' . $this->file->getExtension();
                $this->file->saveAs('@webroot/uploads/' . $newName);
                $this->filePath = $newName;

            return true;
        }

        return false;
    }
}