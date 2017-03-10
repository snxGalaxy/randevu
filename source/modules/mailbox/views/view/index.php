<?php

use app\components\helpers\Html;
use yii\web\View;

/* @var $this View */

$this->title = Yii::t('app/mailbox', 'Mailbox');
$this->params['breadcrumbs'] = [
    ['label' => $this->title],
];
$this->params['pageActions'] = [
    Html::a('<i class="fa fa-edit"></i>' . Yii::t('app/mailbox', 'Compose Mail'), ['#'], ['class' => 'btn btn-app']),
];

?>

<p>Nice mailbox here...</p>
