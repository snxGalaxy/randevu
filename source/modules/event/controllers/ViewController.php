<?php

namespace app\modules\event\controllers;

use app\components\custom\CWebController;

class ViewController extends CWebController
{
    public function actionIndex()
    {
        return $this->render('index', []);
    }
}
