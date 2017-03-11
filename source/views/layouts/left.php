<?php

use app\components\widgets\Menu;
use yii\web\View;

/* @var $this View */

?>

<aside class="main-sidebar">
    <section class="sidebar">
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="<?= Yii::t('app/layout/left', 'Search...') ?>"/>
                <span class="input-group-btn">
                    <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>

        <?= Menu::widget([
            'options' => ['class' => 'sidebar-menu'],
            'items' => [
                ['label' => Yii::t('app/layout/left', 'Statistics'), 'icon' => 'fa fa-tachometer', 'url' => ['/statistics/view/index']],
                ['label' => Yii::t('app/layout/left', 'Profiles'), 'icon' => 'fa fa-users', 'url' => ['/profile/view/index']],
                ['label' => Yii::t('app/layout/left', 'Events'), 'icon' => 'fa fa-calendar', 'badge' => $this->params['counters']['events'], 'url' => ['/event/view/index']],
                ['label' => Yii::t('app/layout/left', 'Mailbox'), 'icon' => 'fa fa-envelope', 'badge' => $this->params['counters']['mailbox'], 'url' => ['/mailbox/view/index']],
                ['label' => Yii::t('app/layout/left', 'Blacklist'), 'icon' => 'fa fa-eye-slash', 'url' => ['/blacklist/view/index']],
                ['label' => Yii::t('app/layout/left', 'System Journal'), 'icon' => 'fa fa-laptop', 'badge' => $this->params['counters']['systemJournal'], 'url' => ['/systemJournal/view/index']],
            ],
        ]) ?>
    </section>
</aside>
