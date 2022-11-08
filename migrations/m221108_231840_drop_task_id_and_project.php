<?php

use yii\db\Migration;

/**
 * Class m221108_231840_drop_task_id_and_project
 */
class m221108_231840_drop_task_id_and_project extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('project', 'task_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221108_231840_drop_task_id_and_project cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221108_231840_drop_task_id_and_project cannot be reverted.\n";

        return false;
    }
    */
}
