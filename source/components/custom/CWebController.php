<?php

namespace app\components\custom;

use app\modules\event\models\Event;
use app\modules\mailbox\models\Letter;
use app\modules\systemJournal\models\SystemJournal;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
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
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    '*' => ['get'],
                ],
            ],
        ];
    }
    
    public function beforeAction($action)
    {
        if (!Yii::$app->user->identity->is_active) {
            Yii::$app->user->logout();
            
            $this->goHome();
        }
        
        Yii::$app->view->params['counters'] = [
            'events' => Event::find()->where(['>=', 'begins_at', 'NOW()'])->count(),
            'mailbox' => Letter::find()->where(['deleted_at' => null, 'is_readed' => 0])->count(),
            'systemJournal' => SystemJournal::find()->where(['deleted_at' => null, 'is_readed' => 0])->count(),
        ];
        
        return parent::beforeAction($action);
    }
}
