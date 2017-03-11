<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\components\custom;

use yii\filters\VerbFilter;

/**
 * Description of CActionsController
 *
 * @author snx
 */
class CActionsController extends CWebController
{
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    '*' => ['post'],
//                    'create' => ['post', 'ajax'],
                ],
            ],
        ]);
    }
}
