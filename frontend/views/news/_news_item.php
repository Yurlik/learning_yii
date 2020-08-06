<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
/* @var $this yii\web\View */


?>


<div class="news-item">
    <h3><?= HTML::tag('a', $model->title, ['href' => '/news/'.$model->seourl]) ?></h3>
    <?='<div class="news-item_pic">'.Html::img('/uploads/'.$model->image, ['alt' => $model->image]).'</div>'?>
    <?= HtmlPurifier::process($model->description) ?>
    <hr>
</div>


