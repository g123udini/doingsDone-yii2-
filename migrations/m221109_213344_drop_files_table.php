<?php

use yii\db\Migration;

/**
 * Handles the dropping of table `{{%files}}`.
 */
class m221109_213344_drop_files_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropTable('file');
        $this->addColumn('task', 'file', 'VARCHAR(320)');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->createTable('{{%files}}', [
            'id' => $this->primaryKey(),
        ]);
    }
}
