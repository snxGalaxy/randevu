<?php

use app\components\helpers\Html;
use app\components\helpers\TimeHelper;
use app\models\Severity;
use app\modules\systemJournal\models\SystemJournalForm;
use app\modules\systemJournal\models\SystemJournalSearch;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\web\View;

/* @var $this View */
/* @var $systemJournalSearch SystemJournalSearch */
/* @var $systemJournalView ActiveDataProvider */
/* @var $systemJournalForm SystemJournalForm */

$this->title = Yii::t('app/systemJournal', 'System Journal');
$this->params['breadcrumbs'] = [
    ['label' => $this->title],
];
$this->params['pageActions'] = [
    Html::pageActionModal('fa-edit', Yii::t('app/systemJournal', 'Add Journal Record'), '#mdl-new-record-form'),
    Html::pageActionLink('fa-envelope-o', Yii::t('app/systemJournal', 'Mark All As Readed'), ['/systemJournal/actions/mark-all-as-readed'], Yii::t('app/systemJournal', 'Are you sure you want to mark all system journal records as readed?')),
    Html::pageActionLink('fa-trash', 'View Deleted', ['/systemJournal/view/deleted'], null, false),
];

$formCreate = ActiveForm::begin([
    'id' => 'frm-create-journal-record',
    'action' => ['/systemJournal/actions/create'],
]);
Modal::begin([
    'id' => 'mdl-new-record-form',
    'header' => sprintf('<h4 class="modal-title">%s</h4>', Yii::t('app/systemJournal', 'New System Journal Record')),
    'footer' => Html::modalSubmitButton() . Html::modalCancelButton(),
]);
echo $formCreate->field($systemJournalForm, 'severity')->dropDownList(array_combine(Severity::listSeverities(), Severity::listSeverities()));
echo $formCreate->field($systemJournalForm, 'subject');
echo $formCreate->field($systemJournalForm, 'content')->textarea();
Modal::end();
ActiveForm::end();

?>

<div class="row">
    <div class="col-md-12">
        <?= GridView::widget([
            'dataProvider' => $systemJournalView,
            'filterModel' => $systemJournalSearch,
            'rowOptions' => function ($model) {
                $class = '';
                
                if ($model->cIsReaded == 0) {
                    $class .= ' text-bold';
                }
                
                return ['class' => $class];
            },
            'columns' => [
                [
                    'attribute' => 'cCreatedAt',
                    'options' => ['width' => '150px'],
                    'filter' => false,
                    'value' => function ($model) {
                        return TimeHelper::format($model->cCreatedAt, TimeHelper::FORMAT_PRETTY);
                    },
                ],
                [
                    'attribute' => 'cSeverity',
                    'options' => ['width' => '120px'],
                    'filter' => Html::activeDropDownList($systemJournalSearch, 'cSeverity', array_combine(Severity::listSeverities(), Severity::listSeverities()), ['class' => 'form-control', 'prompt' => 'All']),
                    'format' => 'html',
                    'value' => function ($model) {
                        $labelClass = 'label-info';
                        
                        switch ($model->cSeverity) {
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
                        
                        return Html::tag('span', $model->cSeverity, ['class' => 'label ' . $labelClass]);
                    },
                ],
                [
                    'attribute' => 'cReporter',
                    'options' => ['width' => '120px'],
                ],
                [
                    'attribute' => 'cSubject',
                    'contentOptions' => ['style' => 'white-space: nowrap;'],
                    'format' => 'html',
                    'value' => function ($model) {
                        return Html::a($model->cSubject, ['/systemJournal/details/index', 'id' => $model->cId]);
                    },
                ],
                [
                    'format' => 'raw',
                    'options' => ['width' => '50px'],
                    'value' => function ($model) {
                        $dropdownItems = [];
                        
                        if ($model->cIsReaded) {
                            $dropdownItems[] = Html::actionDropdownLink('fa-envelope', Yii::t('app/systemJournal', 'Mark As Unreaded'), ['/systemJournal/actions/mark-as-readed', 'id' => $model->cId, 'isReverse' => true]);
                        } else {
                            $dropdownItems[] = Html::actionDropdownLink('fa-envelope-o', Yii::t('app/systemJournal', 'Mark As Readed'), ['/systemJournal/actions/mark-as-readed', 'id' => $model->cId]);
                        }
                        
                        if (!$model->cDeletedAt) {
                            $dropdownItems[] = Html::actionDropdownLink('fa-trash', Yii::t('app/systemJournal', 'Delete'), ['/systemJournal/actions/delete', 'id' => $model->cId], Yii::t('app/systemJournal', 'Are you sure you want to delete system journal record "{0}"?', $model->cSubject));
                        }
                        
                        return Html::actionDropdown($dropdownItems);
                    },
                ],
            ],
        ]) ?>
    </div>
</div>
