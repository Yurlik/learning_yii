<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "uniq_news_visitors".
 *
 * @property int $id
 * @property int|null $news_id
 * @property string|null $client_ip
 * @property string|null $client_agent
 *
 * @property News $news
 */
class UniqNewsVisitors extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'uniq_news_visitors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['news_id'], 'integer'],
            [['client_ip', 'client_agent'], 'string', 'max' => 255],
            [['news_id'], 'exist', 'skipOnError' => true, 'targetClass' => News::className(), 'targetAttribute' => ['news_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'news_id' => 'News ID',
            'client_ip' => 'Client Ip',
            'client_agent' => 'Client Agent',
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
}
