<?php

namespace app\modules\systemJournal\controllers;

use app\components\custom\CActionsController;
use app\modules\systemJournal\models\SystemJournal;
use app\modules\systemJournal\models\SystemJournalForm;
use Yii;
use yii\web\Response;
use yii\widgets\ActiveForm;

class ActionsController extends CActionsController
{
    public function actionCreate()
    {
        $systemJournalForm = new SystemJournalForm();

        if ($systemJournalForm->load(Yii::$app->request->post())) {
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                
                return ActiveForm::validate($systemJournalForm);
            }
            
            $systemJournalForm->create();
        }
        
        $this->goBack();
    }
    
    public function actionMarkAsReaded($id, $isReverse = false)
    {
        if ($isReverse) {
            Yii::$app->user->setReturnUrl(['/systemJournal/view/index']);
        }
        
        SystemJournal::updateAll(['is_readed' => $isReverse ? 0 : 1], ['id' => $id]);
        $this->goBack();
    }
    
    public function actionMarkAsUnreaded($id)
    {
        Yii::$app->user->setReturnUrl(['systemJournal/view/index']);
        SystemJournal::updateAll(['is_readed' => 0], ['id' => $id]);
        $this->goBack();
    }
    
    public function actionDelete($id, $isReverse = false)
    {
        SystemJournal::updateAll(['deleted_at' => $isReverse ? null : 'NOW()'], ['id' => $id]);
        $this->goBack();
    }
}
