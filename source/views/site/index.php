<?php

/* @var $this yii\web\View */

$this->title = Yii::t('app/site/index', 'Statistics');
$this->params['breadcrumbs'] = [
    ['label' => 'Home', 'url' => ['/site/index']],
    ['label' => $this->title],
];

?>

<button data-toggle="modal" data-target="#test-modal">test modal</button>

<?php yii\bootstrap\Modal::begin([
    'id' => 'test-modal',
    'header' => 'Test Modal',
    'footer' => '<button class="btn" data-dismiss="modal">Cancel</button>',
]) ?>

<p>Some modal content goes here</p>

<?php yii\bootstrap\Modal::end() ?>
