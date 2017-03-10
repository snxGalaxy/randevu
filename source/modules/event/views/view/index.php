<?php

use app\components\helpers\Html;
use yii\web\View;

/* @var $this View */

$this->title = Yii::t('app/event', 'Events');
$this->params['breadcrumbs'] = [
    ['label' => $this->title],
];
$this->params['pageActions'] = [
    Html::a('<i class="fa fa-calendar-plus-o"></i>' . Yii::t('app/event', 'New Event'), ['#'], ['class' => 'btn btn-app']),
];

?>

<p>Calendar with events will be rendered here...</p>
