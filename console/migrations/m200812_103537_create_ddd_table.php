<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ddd}}`.
 */
class m200812_103537_create_ddd_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ddd}}', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%ddd}}');
    }
}
