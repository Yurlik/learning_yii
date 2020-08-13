<?php

namespace frontend\controllers;

//use backend\components\Controller;
use Yii;
use yii\web\Controller;

/**
 * MigrateController class.
 *
 * @author Iskryzhytskyi Oleksandr <oleksandr.iskryzhytskyi@gmail.com>
 * @date 08.06.2020 14:27
 */
class MigrateController extends Controller
{

    /**
     * @return string
     */
    public function actionRun()
    {
        // https://github.com/yiisoft/yii2/issues/1764#issuecomment-42436905
        $oldApp = Yii::$app;
        new \yii\console\Application([
            'id' => 'Command runner',
            'basePath' => '@app',
            'components' => [
                'db' => $oldApp->db,
            ],
        ]);
        Yii::$app->runAction('migrate/up', ['migrationPath' => '@console/migrations/', 'interactive' => false]);
        Yii::$app = $oldApp;
    }


    
}