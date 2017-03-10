<?php

namespace app\controllers;

use app\components\custom\CWebController;
use app\modules\user\models\LoginForm;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;

class SiteController extends CWebController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    ['allow' => true, 'roles' => ['@'], 'actions' => ['index', 'logout']],
                    ['allow' => true, 'roles' => ['?'], 'actions' => ['logout']],
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

    public function actions()
    {
        return [
            'error' => ['class' => 'yii\web\ErrorAction'],
        ];
    }

    public function actionIndex()
    {
        $this->redirect(Url::toRoute('/statistics/view/index'));
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        
        $loginForm = new LoginForm([
            'isRemember' => true,
        ]);
        
        if ($loginForm->load(Yii::$app->request->post()) && $loginForm->login()) {
            return $this->goHome();
        }
        
        $this->layout = 'main-login';
        
        return $this->render('login', [
            'loginForm' => $loginForm,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

}
