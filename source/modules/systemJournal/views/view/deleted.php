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
/* @var $systemJournalDeleted ActiveDataProvider */

$this->title = Yii::t('app/systemJournal', 'Deleted Records');
$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app/systemJournal', 'System Journal'), 'url' => ['/systemJournal/view/index']],
    ['label' => $this->title],
];
$this->params['pageActions'] = [
    Html::pageActionLink('fa-arrow-left', 'Back To List', ['/systemJournal/view/index'], null, false),
];

?>

<div class="row">
    <div class="col-md-12">
        <?= GridView::widget([
            'dataProvider' => $systemJournalDeleted,
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
                        
                        if ($model->cDeletedAt) {
                            $dropdownItems[] = Html::actionDropdownLink('fa-trash-o', Yii::t('app/systemJournal', 'Restore'), ['/systemJournal/actions/delete', 'id' => $model->cId, 'isReverse' => true], Yii::t('app/systemJournal', 'Are you sure you want to restore system journal record "{0}"?', $model->cSubject));
                        }
                        
                        return Html::actionDropdown($dropdownItems);
                    },
                ],
            ],
        ]) ?>
    </div>
</div>
