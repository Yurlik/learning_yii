<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index news_block">

    <h2>News</h2>
    <div class="body-content">

        <div class="row">
            <div class="col-lg-12">
                <?php foreach ($news as $new): ?>
                <?php echo '<div class="news_item">';?>
                    <?php echo '<div class="news_title"><h4>'.HTML::tag('a', $new->title, ['href' => '/news/'.$new->seourl]).'</h4></div>';?>
                    <?php echo '<div class="news_desc">'.$new->description.'</div>';?>
                <?php echo '</div>';?>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</div>
