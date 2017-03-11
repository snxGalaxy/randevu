<?php

use app\components\helpers\Html;
use app\components\helpers\TimeHelper;
use app\models\Severity;
use app\modules\systemJournal\models\SystemJournal;
use yii\web\View;

/* @var $this View */
/* @var $systemJournal SystemJournal */

$this->title = Yii::t('app/systemJournal', 'Record Details');
$this->params['breadcrumbs'] = [
    ['label' => 'System Journal', 'url' => ['/systemJournal/view/index']],
    ['label' => $this->title],
];
$this->params['pageActions'] = [
    Html::pageActionLink('fa-arrow-left', Yii::t('app/systemJournal', 'Back To List'), ['/systemJournal/view/index'], null, false),
    $systemJournal->deleted_at
        ? Html::pageActionLink('fa-trash-o', Yii::t('app/systemJournal', 'Restore Record'), ['/systemJournal/actions/delete', 'id' => $systemJournal->id, 'isReverse' => true])
        : Html::pageActionLink('fa-trash', Yii::t('app/systemJournal', 'Delete Record'), ['/systemJournal/actions/delete', 'id' => $systemJournal->id]),
    Html::pageActionLink('fa-envelope-o', Yii::t('app/systemJournal', 'Mark As Unreaded'), ['/systemJournal/actions/mark-as-readed', 'id' => $systemJournal->id, 'isReverse' => true]),
];
$labelClass = 'label-info';

switch ($systemJournal->severity_name) {
    case Severity::SEVERITY_NOTICE:
        $labelClass = 'label-primary';
        break;
    case Severity::SEVERITY_WARNING:
        $labelClass = 'label-warning';
        break;
    case Severity::SEVERITY_ERROR:
    case Severity::SEVERITY_FATAL:
        $labelClass = 'label-danger';
        break;
}

?>

<div class="row">
    <div class="col-md-4 col-sm-12">
        <table class="table">
            <tr>
                <td><i class="fa fa-user"></i></td>
                <td class="text-bold"><?= $systemJournal->getAttributeLabel('reporter_user_name') ?></td>
                <td><?= $systemJournal->reporter_user_name ?></td>
            </tr>
            <tr>
                <td><i class="fa fa-exclamation-triangle"></i></td>
                <td class="text-bold"><?= $systemJournal->getAttributeLabel('severity_name') ?></td>
                <td><?= Html::tag('span', $systemJournal->severity_name, ['class' => 'label ' . $labelClass]) ?></td>
            </tr>
            <tr>
                <td><i class="fa fa-clock-o"></i></td>
                <td class="text-bold"><?= $systemJournal->getAttributeLabel('created_at') ?></td>
                <td><?= TimeHelper::format($systemJournal->created_at, TimeHelper::FORMAT_PRETTY) ?></td>
            </tr>
        </table>
    </div>
    
    <div class="col-md-8 col-sm-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?= $systemJournal->subject ?></h3>
            </div>
            
            <div class="box-body" style="min-height: 200px;">
                <?php
                if (empty($systemJournal->content)) :
                ?>
                    <p class="text-center text-muted" style="margin-top: 60px;"><?= Yii::t('app/systemJournal', 'No details provided') ?></p>
                <?php
                else :
                ?>
                    <p><?= $systemJournal->content ?></p>
                <?php
                endif;
                ?>
            </div>
        </div>
    </div>
</div>
