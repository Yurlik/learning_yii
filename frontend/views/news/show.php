<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index news_block">

    <h2><?=$new->title?></h2>
    <div class="body-content">

        <div class="row">
            <div class="col-lg-12">
                <?php if($new->image){
                    echo  '<div class="news_pic">'.Html::img('/uploads/'.$new->image, ['alt' => $new->image]).'</div>';
                } ?>
                <?php
                    echo '<div class="news_text">'.$new->text.'</div>';
                ?>
            </div>
        </div>

    </div>
</div>
