<?php

namespace app\modules\systemJournal\controllers;

use app\components\custom\CWebController;
use app\modules\systemJournal\models\SystemJournalForm;
use app\modules\systemJournal\models\SystemJournalSearch;
use Yii;

class ViewController extends CWebController
{
    public function actionIndex()
    {
        Yii::$app->user->setReturnUrl(['systemJournal/view/index']);
        $systemJournalSearch = new SystemJournalSearch();
        $systemJournalView = $systemJournalSearch->view(Yii::$app->request->get('SystemJournalSearch'));
        $systemJournalForm = new SystemJournalForm();
        
        return $this->render('index', [
            'systemJournalSearch' => $systemJournalSearch,
            'systemJournalView' => $systemJournalView,
            'systemJournalForm' => $systemJournalForm,
        ]);
    }
    
    public function actionDeleted()
    {
        Yii::$app->user->setReturnUrl(['systemJournal/view/deleted']);
        $systemJournalSearch = new SystemJournalSearch();
        $systemJournalDeleted = $systemJournalSearch->deleted(Yii::$app->request->get('SystemJournalSearch'));
        $systemJournalForm = new SystemJournalForm();
        
        return $this->render('deleted', [
            'systemJournalSearch' => $systemJournalSearch,
            'systemJournalDeleted' => $systemJournalDeleted,
            'systemJournalForm' => $systemJournalForm,
        ]);
    }
}
