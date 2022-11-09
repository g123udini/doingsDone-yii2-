<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property string $name
 * @property int $user_id
 * @property string|null $dt_add
 * @property string|null $deadline
 * @property int|null $status
 *
 * @property File[] $files
 * @property Project $project
 * @property Project[] $projects
 * @property User $user
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'user_id'], 'required'],
            [['user_id', 'status'], 'integer'],
            [['dt_add', 'deadline'], 'safe'],
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
            'name' => 'Name',
            'project_id' => 'Project ID',
            'user_id' => 'User ID',
            'dt_add' => 'Dt Add',
            'deadline' => 'Deadline',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Project]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::class, ['id' => 'project_id']);
    }

    /**
     * Gets query for [[Projects]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTaskProjects()
    {
        return $this->hasMany(ProjectTask::class, ['task_id' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public static function getQueryTasksByProject($id)
    {
        return Task::find()
            ->where(['project_id' => $id])
            ->join('JOIN', 'project_task', 'task.id=task_id')
            ->orderBy(['dt_add' => 'DESC']);
    }
}
