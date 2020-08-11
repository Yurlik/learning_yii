<?php
/**
 * Created by PhpStorm.
 * User: yuser
 * Date: 11.08.2020
 * Time: 17:07
 */

namespace backend\controllers;


use yii\web\Controller;
use Yii;

class RoleController extends Controller
{

    public function actionInit(){

        if(!Yii::$app->authManager->getRole('admin')){
            $admin = Yii::$app->authManager->createRole('admin');
            $admin->description = 'Администратор';
            Yii::$app->authManager->add($admin);

            $role_admin = Yii::$app->authManager->getRole('admin');
        }
        if(!Yii::$app->authManager->getRole('user')){
            $user = Yii::$app->authManager->createRole('user');
            $user->description = 'Пользователь';
            Yii::$app->authManager->add($user);

            $role_user = Yii::$app->authManager->getRole('user');
        }
        if(!Yii::$app->authManager->getPermission('createNews')) {
            $createNews = Yii::$app->authManager->createPermission('createNews');
            $createNews->description = 'Create News';
            Yii::$app->authManager->add($createNews);

            $p_createNews = Yii::$app->authManager->getPermission('createNews');
            Yii::$app->authManager->addChild($role_admin, $p_createNews);
            Yii::$app->authManager->addChild($role_user, $p_createNews);
        }
        if(!Yii::$app->authManager->getPermission('updateNews')) {
            $updateNews = Yii::$app->authManager->createPermission('updateNews');
            $updateNews->description = 'Update News';
            Yii::$app->authManager->add($updateNews);

            $p_updateNews = Yii::$app->authManager->getPermission('updateNews');
            Yii::$app->authManager->addChild($role_admin, $p_updateNews);
        }
        if(!Yii::$app->authManager->getPermission('allowNews')) {
            $allowNews = Yii::$app->authManager->createPermission('allowNews');
            $allowNews->description = 'Allow News';
            Yii::$app->authManager->add($allowNews);

            $p_allowNews = Yii::$app->authManager->getPermission('allowNews');
            Yii::$app->authManager->addChild($role_admin, $p_allowNews);
        }


        return 'roles added';
    }

}