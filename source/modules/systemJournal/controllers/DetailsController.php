<?php

namespace app\modules\systemJournal\controllers;

use app\components\custom\CWebController;
use app\components\helpers\ArrayHelper;
use app\modules\systemJournal\models\SystemJournal;
use Yii;
use yii\db\Exception;

class DetailsController extends CWebController
{
    public function actionIndex($id)
    {
        Yii::$app->user->setReturnUrl(['systemJournal/details/index', 'id' => $id]);
        $systemJournal = SystemJournal::findOne($id);
        
        if (!$systemJournal->is_readed) {
            $systemJournal->is_readed = 1;
            
            if (!$systemJournal->update()) {
                throw new Exception('Failed to mark record as readed: ' . implode('; ', ArrayHelper::extractValues($systemJournal->getErrors())));
            }
        }
        
        return $this->render('index', [
            'systemJournal' => $systemJournal,
        ]);
    }
}
