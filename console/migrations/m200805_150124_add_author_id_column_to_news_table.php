<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%news}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 */
class m200805_150124_add_author_id_column_to_news_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%news}}', 'author_id', $this->integer()->defaultValue(1)->notNull());

        // creates index for column `author_id`
        $this->createIndex(
            '{{%idx-news-author_id}}',
            '{{%news}}',
            'author_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-news-author_id}}',
            '{{%news}}',
            'author_id',
            '{{%user}}',
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
            '{{%fk-news-author_id}}',
            '{{%news}}'
        );

        // drops index for column `author_id`
        $this->dropIndex(
            '{{%idx-news-author_id}}',
            '{{%news}}'
        );

        $this->dropColumn('{{%news}}', 'author_id');
    }
}
