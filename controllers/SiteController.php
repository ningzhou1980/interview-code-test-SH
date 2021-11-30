<?php

namespace app\controllers;

use app\models\User;
use app\models\UserForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new UserForm();

        $model->userName = 'House Stark';

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            /*
             * In real page, we should have user login status. So I can call
             * $user = Yii::$app->user->identity to get login user model and change the
             * points by $user->steps = $model->steps, then save value by $user->save()
             * or:
             * $user = User::findOne(['name' => $model->userName]);
             * $user->steps = $model->steps;
             * $user->save()
             */

            //change value in the cache
            $model->saveStepInCache();
        }

        return $this->render('index', ['model' => $model]);
    }
}
