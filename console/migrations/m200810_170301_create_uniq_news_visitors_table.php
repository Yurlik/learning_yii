<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%uniq_news_visitors}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%news}}`
 */
class m200810_170301_create_uniq_news_visitors_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%uniq_news_visitors}}', [
            'id' => $this->primaryKey(),
            'news_id' => $this->integer(),
            'client_ip' => $this->string(),
            'client_agent' => $this->string(),
        ]);

        // creates index for column `news_id`
        $this->createIndex(
            '{{%idx-uniq_news_visitors-news_id}}',
            '{{%uniq_news_visitors}}',
            'news_id'
        );

        // add foreign key for table `{{%news}}`
        $this->addForeignKey(
            '{{%fk-uniq_news_visitors-news_id}}',
            '{{%uniq_news_visitors}}',
            'news_id',
            '{{%news}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%news}}`
        $this->dropForeignKey(
            '{{%fk-uniq_news_visitors-news_id}}',
            '{{%uniq_news_visitors}}'
        );

        // drops index for column `news_id`
        $this->dropIndex(
            '{{%idx-uniq_news_visitors-news_id}}',
            '{{%uniq_news_visitors}}'
        );

        $this->dropTable('{{%uniq_news_visitors}}');
    }
}
