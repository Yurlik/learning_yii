<?php

namespace common\models;

use Yii;
use yii\db\Query;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "news_tags".
 *
 * @property int $id
 * @property int $tag_id
 * @property int|null $news_id
 *
 * @property News $news
 * @property Tag $tag
 */
class NewsTags extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'news_tags';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tag_id'], 'required'],
            [['tag_id', 'news_id'], 'integer'],
            [['news_id'], 'exist', 'skipOnError' => true, 'targetClass' => News::className(), 'targetAttribute' => ['news_id' => 'id']],
            [['tag_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tag::className(), 'targetAttribute' => ['tag_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tag_id' => 'Tag ID',
            'news_id' => 'News ID',
        ];
    }

    /**
     * Gets query for [[News]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNews()
    {
        return $this->hasOne(News::className(), ['id' => 'news_id']);
    }

    /**
     * Gets query for [[Tag]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTag()
    {
        return $this->hasOne(Tag::className(), ['id' => 'tag_id']);
    }

    /*
     * Most popular tags
     */

    public static function getMostPopTags($limit)
    {

        $subQuery = (new Query())->select(['*'])->from('tag');
        $tags_names = (new Query())->select(['tag_name'])->from('news_tags')->leftJoin(['u' => $subQuery], 'u.id = tag_id')->groupBy('tag_id')->orderBy('COUNT(*) DESC')->limit($limit)->all();

        return $tags_names;
    }

}