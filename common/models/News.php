<?php
namespace common\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property string|null $text
 * @property int|null $status
 * @property string|null $image
 * @property int $created_at
 * @property string|null $seourl
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'created_at'], 'required'],
            [['description', 'text', 'seourl'], 'string'],
            [['status', 'created_at'], 'integer'],
            [['image'], 'file',
                'extensions' => ['jpg', 'jpeg', 'png', 'gif'],
                'checkExtensionByMimeType' => true,

            ],
            [['title'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'text' => 'Text',
            'status' => 'Status',
            'image' => 'Image',
            'created_at' => 'Created At',
            'seourl' => 'Seourl',
        ];
    }

    public function upload()
    {

        $this->image = UploadedFile::getInstance($this, 'image');
//var_dump($this->image);die;
        if(($this->image)){
            $image_file_name = rand(0, 9999).'.'.$this->image->getExtension();

            $this->image->saveAs( Yii::getAlias('@uploads'). '\\' . $image_file_name);
            $this->image = $image_file_name;

            return $this->image;
        }
        return false;
    }

    public static function getPopNews($days, $limit){
        $time = time() - 86400*$days;
        return self::find()->where(['status' => 1])->andWhere('created_at > '.$time.'')->orderBy(['uniq_reader_counter'=>SORT_DESC ])->asArray()->limit($limit)->all();
    }



}
