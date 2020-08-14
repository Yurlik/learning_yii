<?php
/**
 * Created by PhpStorm.
 * User: yuser
 * Date: 03.08.2020
 * Time: 16:29
 */

namespace frontend\controllers;

use Yii;
use common\models\News;
use common\models\NewsSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\NewsComments;
use common\models\UniqNewsVisitors;
use common\models\Tag;
use backend\controllers\TagController;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use common\models\User;

class NewsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create'],
                'rules' => [
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['createNews'],
                    ],

                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all News models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NewsSearch();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider = new ActiveDataProvider([
            'query' => News::find()->where(['status'=>1])->orderBy('id DESC'),
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionMynews()
    {
//        var_dump(Yii::$app->user->id);die;
        $searchModel = new NewsSearch();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider = new ActiveDataProvider([
            'query' => News::find()->where(['status'=>[0, 2]])->andWhere(['author_id'=>Yii::$app->user->id])->orderBy('id DESC'),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        return $this->render('mynews', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionToCheck($id)
    {
        if($model = News::find()->where(['id'=>$id])->one()) {
            $model::updateAll(['status' => 2], ['id'=>$id]);
        }
        return true;
    }

    public function actionFromCheck($id)
    {
        if($model = News::find()->where(['id'=>$id])->one()) {
            $model::updateAll(['status' => 0], ['id'=>$id]);

        }
        return true;
    }

    public function actionPublish($id)
    {
        if($model = News::find()->where(['id'=>$id])->one()) {
            $model::updateAll(['status' => 1], ['id'=>$id]);

            $author = User::find()->where(['id'=>$model->author_id])->one();
            Yii::$app->mailer->compose()
                ->setFrom('yuriycheryavski@gmail.com')
                ->setTo($author->email)
                ->setSubject('Ваша статья отмодерирована и опубликована')
                ->setTextBody('Текст сообщения')
                ->setHtmlBody('Ваша статья "'.$model->title.'" отмодерирована и опубликована')
                ->send();

        }
        return true;
    }

    public function actionDecline($id){
        if($model = News::find()->where(['id'=>$id])->one()) {
            $model::updateAll(['status' => 0], ['id' => $id]);
            $author = User::find()->where(['id' => $model->author_id])->one();

            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            Yii::$app->mailer->compose()
                ->setFrom('yuriycheryavski@gmail.com')
                ->setTo($author->email)
                ->setSubject('Ваша статья отклонена')
                ->setTextBody('Текст сообщения')
                ->setHtmlBody('Ваша статья "' . $model->title . '" отклонена. ' . Yii::$app->request->post('decline_text'))
                ->send();

        }
    }

    public function actionNewsForCheck(){
        $searchModel = new NewsSearch();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider = new ActiveDataProvider([
            'query' => News::find()->where(['status'=>[2]])->orderBy('id DESC'),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        return $this->render('news_for_check', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionShow($url){
        $new = News::find()->where(['seourl'=>$url])->one();

        /*uniq clients*/
        $client_agent = Yii::$app->request->getUserAgent();
        $client_ip = Yii::$app->request->getUserIP();
        $as_visit = UniqNewsVisitors::find()->where(['client_agent'=>$client_agent])->andWhere(['client_ip'=>$client_ip])->andWhere(['news_id'=>$new->id])->count();

        if($as_visit == 0){

            News::updateAll(['uniq_reader_counter'=>$new->uniq_reader_counter+1], ['id'=>$new->id]);
            $visit = new UniqNewsVisitors();
            $visit->news_id = $new->id;
            $visit->client_ip = $client_ip;
            $visit->client_agent = $client_agent;
            $visit->save();
        }
        /*comments*/

        $comment = new NewsComments();

        $comments = NewsComments::find()->where(['news_id'=>$new->id])->orderBy(['id' => SORT_DESC ])->all();


        return $this->render('show', [
            'new' => $new,
            'comments' => $comments,
            'comment' => $comment,

        ]);
    }

    /**
     * Displays a single News model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new News model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
//    public function actionCreate()
//    {
//        $model = new News();
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        }
//
//        return $this->render('create', [
//            'model' => $model,
//        ]);
//    }

    public function actionCreate()
    {

        $model = new News();

        if ($model->load(Yii::$app->request->post())) {
            $model->author_id = Yii::$app->user->id;
            $model->created_at = time();
            if($model->description == ''){
                $model->description = substr($model->text, 0, 20) . '...';
            }
            if(!Yii::$app->user->can('admin')){
                $model->status = 0;
            }
            $model->upload();
            $model->save();
            return $this->redirect(['mynews']);
        }



        $arr = Tag::find()->asArray()->all();
        $data = ArrayHelper::map($arr, 'id', 'tag_name');

        return $this->render('create', [
            'model' => $model,
            'data' => $data,
        ]);

    }

    /**
     * Updates an existing News model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing News model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = News::find()->with('tags')->andWhere(['id'=>$id])->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}