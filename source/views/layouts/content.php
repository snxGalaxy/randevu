<?php

use dmstr\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Inflector;
use yii\widgets\Breadcrumbs;

?>

<div class="content-wrapper">
    <section class="content-header">
        <?php if (isset($this->blocks['content-header'])) : ?>
            <h1><?= $this->blocks['content-header'] ?></h1>
        <?php else : ?>
            <h1>
                <?php
                if ($this->title !== null) {
                    echo Html::encode($this->title);
                } else {
                    echo Inflector::camel2words(Inflector::id2camel($this->context->module->id));
                    echo ($this->context->module->id !== Yii::$app->id) ? '<small>Module</small>' : '';
                }
                ?>
            </h1>
        <?php endif; ?>

        <?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : []]) ?>
    </section>
    

    <section class="content">
        <div class="row">
            <div class="col-sm-12 page-actions">
                <?php
                if (array_key_exists('pageActions', $this->params)) {
                    echo implode('', $this->params['pageActions']);
                }
                ?>
            </div>
        </div>
        
        <?= Alert::widget() ?>
        <?= $content ?>
    </section>
</div>

<footer class="main-footer">
    <div class="pull-right hidden-xs"><b>Version</b> <?= Yii::$app->version ?></div>
    <strong>Copyright &copy; 2017 Siderka Eugene</strong> All rights reserved
</footer>

<div class='control-sidebar-bg'></div>
