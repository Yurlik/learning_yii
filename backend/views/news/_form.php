<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model common\models\News */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->dropDownList(['off', 'on']) ?>

    <?= $form->field($model, 'image')->fileInput() ?>

<!--    --><?//= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'seourl')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tags_array')->widget(Select2::class, [
            'data' => $data,
            'language' => 'ru',
            'options' => ['placeholder' => 'Select a tag ...', 'multiple' => true],

            'pluginOptions' => [
                'allowClear' => true,
                'tags' => true,
                'maximumInputLength' => 10
            ],
        ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
