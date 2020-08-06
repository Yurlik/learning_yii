<?php
use yii\helpers\Html;
/**
 * Created by PhpStorm.
 * User: yuser
 * Date: 05.08.2020
 * Time: 20:45
 */

echo '<div class="popnews_item_wrap">';
echo '<h3 class="block_title">Популярные новости</h3>';
foreach ($popnews as $item){
    echo '<div class="popnews_item_wrap">';
        echo '<div class="popnews_item_title">'.HTML::tag('a', $item['title'], ['href' => '/news/'.$item['seourl']]).'</div>';
        echo '<div class="popnews_item_desc">'.$item['description'].'</div>';
    echo '</div><hr>';

}
echo '</div>';