<?php

use app\modules\user\models\Role;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $content string */

?>

<header class="main-header">
    <a href="<?= Yii::$app->homeUrl ?>" class="logo">
        <span class="logo-mini"><i class="fa fa-coffee"></i></span>
        <span class="logo-lg"><i class="fa fa-coffee"></i> <?= Yii::$app->name ?></span>
    </a>

    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only"><?= Yii::t('app/layout/header', 'Toggle navigation') ?></span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li><a href="#" data-toggle="tooltip" data-original-title="<?= Yii::t('app/layout/header', 'New Profile') ?>" data-placement="bottom"><i class="fa fa-user-plus"></i></a></li>
                <li><a href="#" data-toggle="tooltip" data-original-title="<?= Yii::t('app/layout/header', 'New Event') ?>" data-placement="bottom"><i class="fa fa-calendar-plus-o"></i></a></li>
                <li><a href="#" data-toggle="tooltip" data-original-title="<?= Yii::t('app/layout/header', 'Compose Email') ?>" data-placement="bottom"><i class="fa fa-pencil-square-o"></i></a></li>
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-user" style="margin-right: 5px;"></i> <?= Yii::$app->user->identity->name ?>
                        <span class="text-muted"><?= in_array(Yii::$app->user->identity->role_name, Role::listRoles(Role::ROLE_ADMIN)) ? sprintf('(%s)', Yii::$app->user->identity->role_name) : '' ?></span>
                    </a>
                    
                    <ul class="dropdown-menu">
                        <li>
                            <ul class="menu">
                                <li><?= Html::a('<i class="fa fa-sign-out"></i> ' . Yii::t('app/layout/header', 'Logout'), ['/site/logout'], ['data' => ['method' => 'post']]) ?></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
