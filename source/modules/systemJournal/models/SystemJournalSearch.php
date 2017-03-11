<?php

namespace app\modules\systemJournal\models;

use Yii;
use yii\data\ActiveDataProvider;

class SystemJournalSearch extends SystemJournal
{
    public $cId;
    public $cSeverity;
    public $cReporter;
    public $cSubject;
    public $cIsReaded;
    public $cCreatedAt;
    public $cDeletedAt;
    
    public function rules()
    {
        return [
            [['cId', 'cSeverity', 'cReporter', 'cSubject', 'cIsReaded', 'cCreatedAt', 'cDeletedAt'], 'safe'],
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'cId' => Yii::t('app/system-journal', 'ID'),
            'cSeverity' => Yii::t('app/system-journal', 'Severity'),
            'cReporter' => Yii::t('app/system-journal', 'Reporter User'),
            'cSubject' => Yii::t('app/system-journal', 'Subject'),
            'cIsReaded' => Yii::t('app/system-journal', 'Readed'),
            'cCreatedAt' => Yii::t('app/system-journal', 'Reported On'),
            'cDeletedAt' => Yii::t('app/system-journal', 'Deleted'),
        ];
    }
    
    public function view($params)
    {
        $this->setAttributes($params);
        $query = self::find()
                ->filterWhere(['system_journal.id' => $this->cId])
                ->andFilterWhere(['system_journal.severity_name' => $this->cSeverity])
                ->andFilterWhere(['like', 'system_journal.subject', $this->cSubject])
                ->andFilterWhere(['like', 'system_journal.reporter_user_name', $this->cReporter])
                ->select([
                    'system_journal.id AS cId',
                    'system_journal.severity_name AS cSeverity',
                    'system_journal.reporter_user_name AS cReporter',
                    'system_journal.subject AS cSubject',
                    'system_journal.is_readed AS cIsReaded',
                    'system_journal.created_at AS cCreatedAt',
                    'system_journal.deleted_at AS cDeletedAt',
                ]);
        
        if ($this->cDeletedAt) {
            $query->where(['IS NOT', 'deleted_at', null]);
        } else {
            $query->where(['system_journal.deleted_at' => null]);
        }
        
        return new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes' => [
                    'cId' => [
                        'asc' => ['system_journal.id' => SORT_ASC],
                        'desc' => ['system_journal.id' => SORT_DESC],
                    ],
                    'cSseverity' => [
                        'asc' => ['system_journal.reporter_user_name' => SORT_ASC],
                        'desc' => ['system_journal.reporter_user_name' => SORT_DESC],
                    ],
                    'cReporter' => [
                        'asc' => ['system_journal.severity_name' => SORT_ASC],
                        'desc' => ['system_journal.severity_name' => SORT_DESC],
                    ],
                    'cSubject' => [
                        'asc' => ['system_journal.subject' => SORT_ASC],
                        'desc' => ['system_journal.subject' => SORT_DESC],
                    ],
                    'cIsReaded' => [
                        'asc' => ['system_journal.is_readed' => SORT_ASC],
                        'desc' => ['system_journal.is_readed' => SORT_DESC],
                    ],
                    'cCreatedAt' => [
                        'asc' => ['system_journal.created_at' => SORT_ASC],
                        'desc' => ['system_journal.created_at' => SORT_DESC],
                    ],
                ],
                'defaultOrder' => ['cIsReaded' => SORT_ASC, 'cId' => SORT_DESC],
            ],
        ]);
    }
    
    public function deleted($params)
    {
        $this->cDeletedAt = true;
        
        return $this->view($params);
    }
}
