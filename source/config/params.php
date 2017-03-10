<?php

$basePath = dirname(__DIR__);

Yii::setAlias('@shared', $basePath . '/shared');

return [
    'adminEmail' => 'admin@example.com',
];
