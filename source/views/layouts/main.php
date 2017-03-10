<?php

use app\assets\AppAsset;
use dmstr\web\AdminLteAsset;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $content string */

AppAsset::register($this);
AdminLteAsset::register($this);

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');

?>

<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= sprintf('%s - %s', Yii::$app->name, Html::encode($this->title)) ?></title>
        <?php $this->head() ?>
    </head>

    <body class="hold-transition skin-black-light sidebar-mini">
        <?php $this->beginBody() ?>

        <div class="wrapper">
            <?= $this->render('header.php', ['directoryAsset' => $directoryAsset]) ?>
            <?= $this->render('left.php', ['directoryAsset' => $directoryAsset]) ?>
            <?= $this->render('content.php', ['content' => $content, 'directoryAsset' => $directoryAsset]) ?>
        </div>

        <?php $this->endBody() ?>
    </body>
</html>

<?php $this->endPage() ?>
