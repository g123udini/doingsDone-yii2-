<?php

use yii\db\Migration;

/**
 * Class m221108_160132_add_foreing_key_to_task
 */
class m221108_160132_add_foreing_key_to_task extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('task_project', 'task', 'project_id', 'project', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('task_project', 'task');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221108_160132_add_foreing_key_to_task cannot be reverted.\n";

        return false;
    }
    */
}
