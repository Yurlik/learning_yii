<?php

use yii\helpers\Html;
use frontend\widgets\PopWidget;
use frontend\widgets\PopTagsWidget;
use yii\widgets\ListView;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index news_block">

    <h2>My News</h2>
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
                    'itemView' => 'my_news_item_for_check',
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

<?php
$js = <<<JS
        $('form.publish').on('beforeSubmit', function(){
            var form = $(this);
            var data = form.serialize();
            var id = $(this).find('input[name=news_id]').val();
            console.log(id);
        $.ajax({
            url: '/news/publish?id='+id,
            type: 'POST',
            data: data,
            success: function(data){
                // console.log(data);
                form.closest('.news-item').remove();
            },
            
            error: function(){
                alert('Error!');
            }
        }).done(function(data) {
       if(data.success) {
          // данные сохранены
          console.log(data);
        } else {
          // сервер вернул ошибку и не сохранил наши данные
        }
    });
        return false;
    });

$('form.return').on('beforeSubmit', function(){
            var form = $(this);
            var data = form.serialize();
            var id = $(this).find('input[name=news_id]').val();
            console.log(id);
        $.ajax({
            url: '/news/decline?id='+id,
            type: 'POST',
            data: data,
            success: function(data){
                form.closest('.news-item').remove();
                
            },
            
            error: function(){
                alert('Error!');
            }
        }).done(function(data) {
       if(data.success) {
          // данные сохранены
          console.log(data);
        } else {
          // сервер вернул ошибку и не сохранил наши данные
        }
    });
        return false;
    });


JS;

$this->registerJs($js);
?>
