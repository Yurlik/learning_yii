<?php
/**
 * Created by PhpStorm.
 * User: yuser
 * Date: 07.08.2020
 * Time: 12:25
 */

namespace frontend\widgets;


use common\models\NewsTags;
use yii\base\Widget;

class PopTagsWidget extends Widget
{
    public $limit;

    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
    }

    public function run()
    {
        $poptags = NewsTags::getMostPopTags($this->limit);

        return $this->render(
            'popTags',
            [
                'poptags' => $poptags,
            ]
        );
    }


}