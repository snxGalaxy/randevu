<?php

namespace app\components\helpers;

class Html extends \yii\helpers\Html
{
    public static function pageActionLink($name, $url, $class)
    {
        return self::a($name, $url, ['class' => 'btn btn-flat ' . $class]);
    }
}
