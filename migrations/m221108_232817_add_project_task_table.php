<?php

use yii\db\Migration;

/**
 * Class m221108_232817_add_project_task_table
 */
class m221108_232817_add_project_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('project_task', [
            'id' => 'INT PRIMARY KEY AUTO_INCREMENT',
            'task_id' => 'INT NOT NULL',
            'project_id' => 'INT NOT NULL',]);
        $this->addForeignKey('task_id_project_id', 'project_task', 'task_id', 'task', 'id');
        $this->addForeignKey('project_id_task_id', 'project_task', 'project_id', 'project', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221108_232817_add_project_task_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221108_232817_add_project_task_table cannot be reverted.\n";

        return false;
    }
    */
}
