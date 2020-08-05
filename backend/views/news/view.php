<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model common\models\News */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'News', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="news-view vv">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'description:ntext',
            'text:ntext',
            'status',
//            'image',
//            [
//                'attribute'=>'image',
//                'label'=>'Image',
//                'format'=>'html',
//                'content' => function($model){
//
//                    return Html::img('/uploads/' .$model->image, ['alt'=>'yii','width'=>'250','height'=>'100']);
//                }
//            ],
            [
                'attribute'=>'photo',
                'value'=>Yii::$app->urlManagerBackend->baseUrl.'/'.$model->image,
                'format' => ['image',['width'=>'100','height'=>'auto']],
            ],
            'created_at',
            'seourl:ntext',
        ],
    ]) ?>

    <?php

    echo Html::img(Yii::$app->urlManagerBackend->baseUrl.'/'.$model->image);

    ?>

</div>
