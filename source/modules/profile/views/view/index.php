<?php

use app\components\helpers\Html;
use yii\web\View;

/* @var $this View */

$this->title = Yii::t('app/profile', 'Profiles');
$this->params['breadcrumbs'] = [
    ['label' => $this->title],
];
$this->params['pageActions'] = [
    Html::a('<i class="fa fa-user-plus"></i>' . Yii::t('app/profile', 'New Profile'), ['#'], ['class' => 'btn btn-app']),
];

?>

<p>Profiles list should be here...</p>
