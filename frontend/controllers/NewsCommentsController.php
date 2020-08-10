<?php
/**
 * Created by PhpStorm.
 * User: yuser
 * Date: 10.08.2020
 * Time: 18:56
 */

namespace frontend\controllers;

use common\models\NewsComments;
use yii\web\Controller;
use Yii;


class NewsCommentsController extends Controller
{

    public function actionSave(){
        $model = new NewsComments();
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if(Yii::$app->request->isAjax){
            if($model->load(Yii::$app->request->post())){
                $model->save();
            }
        }
        return Yii::$app->request->post();
    }

}