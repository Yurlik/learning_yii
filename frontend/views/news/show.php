<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


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
<div class="comments_block">
    <h4>Оставить комментарий:</h4>

    <?php $form = ActiveForm::begin();?>

    <?=$form->field($comment, 'author_name')->textInput();   ?>
    <?=$form->field($comment, 'comment')->textarea(['rows' => 3]);  ?>

    <?= Html::hiddenInput('NewsComments[news_id]', $new->id) ?>
    <?= Html::hiddenInput('NewsComments[author_id]', Yii::$app->user->id) ?>

    <?= Html::submitButton('Send', ['class' => 'btn btn-success']) ?>

    <?php ActiveForm::end();    ?>




    <hr>
    <br>
    <div class="comments_list">
        <h4>Комментарии:</h4>
        <div class="comments_list_ins"></div>
        <?php foreach($comments as $com): ?>
            <?='<div class="comment" style="margin: 10px; border: 1px solid #ccccff; padding: 5px;">'; ?>
            <?='<div class="author" style="margin-bottom: 10px">'.$com->author_name.'</div>'; ?>
            <?='<div class="comment_text" style="margin-bottom: 10px">'.$com->comment.'</div>'; ?>
            <?='</div>'?>
        <?php endforeach; ?>
    </div>

</div>




<?php
$js = <<<JS
        $('form').on('beforeSubmit', function(){
            var form = $(this);
            var data = form.serialize();
        $.ajax({
            url: '/news-comments/save',
            type: 'POST',
            data: data,
            success: function(data){
                console.log(data);
                form[0].reset();
                $(".comments_list_ins").prepend('<div class="comment" style="margin: 10px; border: 1px solid #ccccff; padding: 5px;">' +
                 '<div class="author_name" style="margin-bottom: 10px">'+ data.NewsComments.author_name +'</div><div class="comment" style="margin-bottom: 10px">'+ data.NewsComments.comment +'</div></div>');
                $('#process').fadeOut();
            },
            
            error: function(){
                console.log(data);
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
