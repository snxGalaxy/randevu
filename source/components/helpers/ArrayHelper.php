<?php

namespace app\components\helpers;

class ArrayHelper extends \yii\helpers\ArrayHelper
{
    public static function divide($array, $value, $isHigher)
    {
        return call_user_func_array('array_splice', array_filter([
            &$array,
            $isHigher ? null : 0,
            array_search($value, $array)
        ], function ($e) {
            return !is_null($e);
        }));
    }
}
