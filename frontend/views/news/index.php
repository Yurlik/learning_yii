<?php

use yii\helpers\Html;
use frontend\widgets\PopWidget;
use frontend\widgets\PopTagsWidget;
use yii\widgets\ListView;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index news_block">

    <h2>News</h2>
    <div class="body-content">

        <div class="row">
            <div class="col-lg-8">
                <?php if(Yii::$app->user->can('createNews')) :   ?>
                    <p>
                        <?= Html::a('Create News', ['create'], ['class' => 'btn btn-success']) ?>
                    </p>
                <?php endif; ?>
                <?=ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemView' => '_news_item',
                    'summary' => '',
                    'viewParams' => [
                        'fullView' => true,
                        'context' => 'main-page',
                    ],
                ])?>
            </div>
            <div class="col-lg-4">
               <?php
                    echo PopWidget::widget(
                        [
                            'days' => 5,
                            'limit' => 3,
                        ]
                    );
                ?>
               <?php
                echo PopTagsWidget::widget(
                        [
                                'limit' => 3,
                        ]
                )
               ?>
            </div>
        </div>


    </div>
</div>
