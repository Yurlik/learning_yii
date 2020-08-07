<?php
/**
 * Created by PhpStorm.
 * User: yuser
 * Date: 07.08.2020
 * Time: 12:25
 */
echo '<div class="popnews_item_wrap">';
echo '<h3 class="block_title">Популярные теги</h3>';
foreach ($poptags as $item){
    echo '<div class="poptags_item_wrap">';
    echo '<div class="poptags_item">#'.$item['tag_name'].'</div>';
    echo '</div><hr>';

}
echo '</div>';