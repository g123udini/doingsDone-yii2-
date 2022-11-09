<?php

namespace app\models\forms;

use app\models\File;
use app\models\Project;
use app\models\ProjectTask;
use app\models\Task;
use DoingsDone\exceptions\ModelSaveException;
use Psy\Readline\Hoa\FileException;
use Yii;
use yii\base\Model;
use yii\db\Exception;

class AddTaskForm extends Model
{
    public $name;
    public $userId;
    public $project_id;
    public $deadline;
    public $files = [];
    public $filePaths = [];

    public function rules()
    {
        return [
            [['name'], 'string'],
            [['name', 'userId'], 'required'],
            [['files'], 'file', 'skipOnEmpty' => true, 'maxFiles' => 4, 'checkExtensionByMimeType' => false],
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

        $transaction = Yii::$app->db->beginTransaction();

        try {
            if (!$task->save()) {
                throw new ModelSaveException('Не удалось сохранить задание');
            }
            if (!$this->saveProjectTask($task)) {
                throw new ModelSaveException('Не удалось сохранить связь между заданием и проектом');
            }
            if ($this->files) {
                $this->saveFilesNames($task);
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

    private function saveFilesNames(Task $task)
    {
        if ($this->uploadFiles()) {
            foreach ($this->filePaths as $filePath) {
                $file = new File();
                $file->name = $filePath;
                $file->task_id = $task->id;
                if (!$file->save()) {
                    throw new ModelSaveException('Не удалось сохранить название файла');
                }
            }
        }
    }

    private function uploadFiles()
    {
        if ($this->files && $this->validate()) {
            foreach ($this->files as $file) {
                $newName = uniqid('uploads') . '.' . $file->getExtension();
                $file->saveAs('@webroot/uploads/' . $newName);
                $this->filePaths[] = $newName;
            }
            return true;
        }

        return false;
    }
}