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

    <?php if($model->status == 0){
        $to_check = 'visible';
        $recall_check = 'hidden';
    }else if ($model->status == 2){
        $to_check = 'hidden';
        $recall_check = 'visible';
    } ?>
<!--    -->
    <?php $form_to = ActiveForm::begin(['options' => [
        'class'=>'to_check '.$to_check
    ]
    ]);?>
    <?= Html::hiddenInput('news_id', $model->id) ?>
    <?= Html::submitButton('Send to check', ['class' => 'btn btn-primary']) ?>
    <?php ActiveForm::end();    ?>

<!--    ajax form to send news for recall checking   -->
    <?php $form_from = ActiveForm::begin(['options' => [
        'class'=>'recall_check '.$recall_check
    ]
    ]);?>
    <?= Html::hiddenInput('news_id', $model->id) ?>
    <?= Html::submitButton('Recall check', ['class' => 'btn btn-warning']) ?>
    <?php ActiveForm::end();    ?>


    <hr>
</div>


