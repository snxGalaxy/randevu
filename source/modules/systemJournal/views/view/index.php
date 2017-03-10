<?php

use app\components\helpers\Html;
use yii\web\View;

/* @var $this View */

$this->title = Yii::t('app/systemJournal', 'System Journal');
$this->params['breadcrumbs'] = [
    ['label' => $this->title],
];
$this->params['pageActions'] = [
];

?>

<p>Table with system events and reports...</p>
