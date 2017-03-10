<?php

use app\modules\user\models\LoginForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $loginForm LoginForm */
/* @var $form ActiveForm */

$this->title = Yii::t('app/site/login', 'Sign In');

?>

<div class="login-box">
    <div class="login-logo">
        <a href="#"><b><?= Yii::$app->name ?></b> v.<?= Yii::$app->version ?></a>
    </div>
    
    <div class="login-box-body">
        <p class="login-box-msg"><?= Yii::t('app/site/login', 'Sign in to start your session') ?></p>
        
        <?php
        $form = ActiveForm::begin([
            'id' => 'login-form',
//            'fieldConfig' => [
//                'template' => $this->render('@app/views/layouts/form-field-template'),
//                'labelOptions' => [
//                    'class' => 'col-md-2 control-label',
//                ],
//            ],
        ]);
        ?>
        
        <?= $form->field($loginForm, 'username')->label(false)->textInput(['placeholder' => $loginForm->getAttributeLabel('username')]) ?>
        
        <?= $form->field($loginForm, 'password')->label(false)->passwordInput(['placeholder' => $loginForm->getAttributeLabel('password')]) ?>
        
        <div class="row">
            <div class="col-xs-8">
                <?= $form->field($loginForm, 'isRemember')->checkbox() ?>
            </div>
            
            <div class="col-xs-4">
                <?= Html::submitButton('Sign in', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'btn-login']) ?>
            </div>
        </div>


        <?php
        ActiveForm::end();
        ?>
    </div>
</div>
