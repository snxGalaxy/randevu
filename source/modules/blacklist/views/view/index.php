<?php

use app\components\helpers\Html;
use yii\web\View;

/* @var $this View */

$this->title = Yii::t('app/blacklist', 'Blacklist');
$this->params['breadcrumbs'] = [
    ['label' => $this->title],
];
$this->params['pageActions'] = [
    Html::a('<i class="fa fa-plus"></i>' . Yii::t('app/blacklist', 'Add Records'), ['#'], ['class' => 'btn btn-app']),
];

?>

<p>Blacklisted emails or websites here...</p>
