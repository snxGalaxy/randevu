<?php

namespace app\components\custom;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class CWebController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    ['allow' => false, 'roles' => ['?']],
                    ['allow' => true, 'roles' => ['@']],
                ],
            ],
        ];
    }
    
    public function beforeAction($action)
    {
//        if (!Yii::$app->user->identity->is_active) {
//            Yii::$app->user->logout();
//            
//            $this->goHome();
//        }
        
        return parent::beforeAction($action);
    }
}
