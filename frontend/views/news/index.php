<?php

use yii\helpers\Html;
use app\components\PopWidget;
use app\components\FirstWidget;
use frontend\widgets\SecondWidget;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index news_block">

    <h2>News</h2>
    <div class="body-content">

        <div class="row">
            <div class="col-lg-8">
                <?php foreach ($news as $new): ?>
                <?php echo '<div class="news_item">';?>
                    <?php echo '<div class="news_title"><h4>'.HTML::tag('a', $new->title, ['href' => '/news/'.$new->seourl]).'</h4></div>';?>
                    <?php echo '<div class="news_desc">'.$new->description.'</div>';?>
                <?php echo '</div>';?>
                <?php endforeach; ?>
            </div>
            <div class="col-lg-4">
                <?=SecondWidget::widget()?>
                <?php
//                echo FirstWidget::widget();
                //echo PopWidget::widget();
//                PopWidget::widget(
//                    [
//                        'days' => 5,
//                        'limit' => 3,
//                    ]
//                );
?>

            </div>
        </div>

    </div>
</div>
