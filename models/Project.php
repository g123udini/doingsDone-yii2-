<?php

namespace app\models;

use Yii;
use yii\db\Query;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "project".
 *
 * @property int $id
 * @property string $name
 * @property int $user_id
 *
 * @property Task $task
 * @property Task[] $tasks
 * @property User $user
 */
class Project extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'user_id'], 'required'],
            [['user_id'], 'integer'],
            [['name'], 'string', 'max' => 320],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название проекта',
            'user_id' => 'User ID',
        ];
    }

    /**
     * Gets query for [[ProjectTasks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProjectTasks()
    {
        return $this->hasMany(ProjectTask::class, ['project_id' => 'id']);
    }

    public static function getProjectsList()
    {
        $projectsList = Project::find()
            ->select(['id', 'name'])
            ->orderBy('id')
            ->asArray()
            ->all();

        return ArrayHelper::map($projectsList, 'id', 'name');
    }

    public static function getProjectsMenu(): array
    {
        $result = [];
        foreach (Project::findAll(['user_id' => Yii::$app->user->id]) as $project) {
            $result[] = ['label' => $project->name, 'url' => ['task/list', 'id' => $project->id]];
        }

        return $result;
    }

    public static function getProjectCount($name)
    {
        return Project::findOne(['name' => $name])->getProjectTasks()->count();
    }
}