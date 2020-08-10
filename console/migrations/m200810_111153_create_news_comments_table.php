<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%news_comments}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%news}}`
 */
class m200810_111153_create_news_comments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%news_comments}}', [
            'id' => $this->primaryKey(),
            'author_id' => $this->integer(),
            'news_id' => $this->integer(),
            'comment' => $this->text(),
            'author_name' => $this->string(),
        ]);

        // creates index for column `author_id`
        $this->createIndex(
            '{{%idx-news_comments-author_id}}',
            '{{%news_comments}}',
            'author_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-news_comments-author_id}}',
            '{{%news_comments}}',
            'author_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `news_id`
        $this->createIndex(
            '{{%idx-news_comments-news_id}}',
            '{{%news_comments}}',
            'news_id'
        );

        // add foreign key for table `{{%news}}`
        $this->addForeignKey(
            '{{%fk-news_comments-news_id}}',
            '{{%news_comments}}',
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
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-news_comments-author_id}}',
            '{{%news_comments}}'
        );

        // drops index for column `author_id`
        $this->dropIndex(
            '{{%idx-news_comments-author_id}}',
            '{{%news_comments}}'
        );

        // drops foreign key for table `{{%news}}`
        $this->dropForeignKey(
            '{{%fk-news_comments-news_id}}',
            '{{%news_comments}}'
        );

        // drops index for column `news_id`
        $this->dropIndex(
            '{{%idx-news_comments-news_id}}',
            '{{%news_comments}}'
        );

        $this->dropTable('{{%news_comments}}');
    }
}
