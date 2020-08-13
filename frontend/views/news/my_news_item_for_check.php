<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */


?>


<div class="news-item">
    <h3><?= HTML::tag('a', $model->title, ['href' => '/news/'.$model->seourl]) ?></h3>
    <?='<div class="news-item_pic">'.Html::img('/uploads/'.$model->image, ['alt' => $model->image]).'</div>'?>
    <?= HtmlPurifier::process($model->description) ?>


<!--    ajax form to send news for checking   -->


<!--    -->
    <?php $form_to = ActiveForm::begin(['options' => [
        'class'=>'publish'
    ]
    ]);?>
    <?= Html::hiddenInput('news_id', $model->id) ?>
    <?= Html::submitButton('Publish', ['class' => 'btn btn-primary']) ?>
    <?php ActiveForm::end();    ?>

<!--    ajax form to send news for recall checking   -->
    <?php $form_from = ActiveForm::begin(['options' => [
        'class'=>'return'
    ]
    ]);?>
    <?= Html::hiddenInput('news_id', $model->id) ?>
    <?= Html::submitButton('Return for revision', ['class' => 'btn btn-warning']) ?>
    <?php ActiveForm::end();    ?>


    <hr>
</div>


