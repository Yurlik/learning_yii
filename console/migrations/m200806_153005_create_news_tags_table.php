<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%news_tags}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%tag}}`
 * - `{{%news}}`
 */
class m200806_153005_create_news_tags_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%news_tags}}', [
            'id' => $this->primaryKey(),
            'tag_id' => $this->integer()->notNull(),
            'news_id' => $this->integer(),
        ]);

        // creates index for column `tag_id`
        $this->createIndex(
            '{{%idx-news_tags-tag_id}}',
            '{{%news_tags}}',
            'tag_id'
        );

        // add foreign key for table `{{%tag}}`
        $this->addForeignKey(
            '{{%fk-news_tags-tag_id}}',
            '{{%news_tags}}',
            'tag_id',
            '{{%tag}}',
            'id',
            'CASCADE'
        );

        // creates index for column `news_id`
        $this->createIndex(
            '{{%idx-news_tags-news_id}}',
            '{{%news_tags}}',
            'news_id'
        );

        // add foreign key for table `{{%news}}`
        $this->addForeignKey(
            '{{%fk-news_tags-news_id}}',
            '{{%news_tags}}',
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
        // drops foreign key for table `{{%tag}}`
        $this->dropForeignKey(
            '{{%fk-news_tags-tag_id}}',
            '{{%news_tags}}'
        );

        // drops index for column `tag_id`
        $this->dropIndex(
            '{{%idx-news_tags-tag_id}}',
            '{{%news_tags}}'
        );

        // drops foreign key for table `{{%news}}`
        $this->dropForeignKey(
            '{{%fk-news_tags-news_id}}',
            '{{%news_tags}}'
        );

        // drops index for column `news_id`
        $this->dropIndex(
            '{{%idx-news_tags-news_id}}',
            '{{%news_tags}}'
        );

        $this->dropTable('{{%news_tags}}');
    }
}
