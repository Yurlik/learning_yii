<?php
/**
 * Created by PhpStorm.
 * User: yuser
 * Date: 10.08.2020
 * Time: 22:28
 */

namespace frontend\controllers;


use yii\web\Controller;
use Yii;

class DatabaseController extends Controller
{

    public function actionMigrate(){


//        //Define, if you want to capture output
//        defined('STDIN') or define('STDIN', fopen('php://input', 'r'));
//        defined('STDOUT') or define('STDOUT', fopen('php://output', 'w'));
////Create new console app, if you do not run it from root namespace you should use '\yii\console\Application'
//        $runner = new \yii\console\Application([
//            'id'       => 'auto-migrate',
//            'controllerNamespace' => 'console\controllers', //for migrate command it should not matter but for other cases you must specify otherwise applocation cannot find your controllers
//            'basePath' => dirname(__DIR__ . '/../../console/config'), //This must point to your console config directory, when i run this in frontend sitecontroller i must add '/../../console/config',
//            'components' => [
//                'db' => [//If you want to call migrate you probably need some database component
//                    'class' => 'yii\db\Connection',
//                    'dsn' => 'mysql:host=localhost;dbname=learning',
//                    'username' => 'root',
//                    'password' => '',
//                    'charset' => 'utf8',
//                ],
//            ],
//        ]);
//        ob_start();
//        try
//        {
//            $runner->runAction('migrate/up');
//        }
//        catch(\Exception $ex)
//        {
//            echo $ex->getMessage();
//        }
//        return htmlentities(ob_get_clean(), null, Yii::$app->charset);

        ob_start();
        try
        {

            $output = Array();
            exec(__DIR__ . '/../../yii migrate --interactive=0', $output);
//            exec('php -v', $output);
            echo implode("\n", $output);
        }
        catch(\Exception $ex)
        {
            echo $ex->getMessage();
        }
        return htmlentities(ob_get_clean(), null, Yii::$app->charset);
    }



}