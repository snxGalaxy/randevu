<?php

use app\components\helpers\Html;
use yii\web\View;

/* @var $this View */

$this->title = Yii::t('app/user', 'Events');
$this->params['breadcrumbs'] = [
    ['label' => $this->title],
];
$this->params['pageActions'] = [
    Html::a('<i class="fa fa-user-plus"></i>' . Yii::t('app/user', 'Add User'), ['#'], ['class' => 'btn btn-app']),
];

?>

<p>Techincal page with users list will be here...</p>
