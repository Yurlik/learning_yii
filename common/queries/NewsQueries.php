<?php
/**
 * Created by PhpStorm.
 * User: yuser
 * Date: 25.08.2020
 * Time: 14:55
 */

namespace common\queries;

use Yii;

class NewsQueries extends \yii\db\ActiveQuery
{

    public function active($state = 1)
    {
        return $this->andWhere(['status' => $state]);
    }

    public function orderById()
    {
        return $this->orderBy('id DESC');
    }

    public function nonactive($state = [0, 2])
    {
        return $this->andWhere(['status' => $state]);
    }

    public function author()
    {
        return $this->andWhere(['author_id'=>Yii::$app->user->id]);
    }
}