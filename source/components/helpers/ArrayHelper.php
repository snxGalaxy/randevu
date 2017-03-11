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
    
    public static function extractValues($array)
    {
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $array = array_merge($array, self::extractValues($value));
                unset($array[$key]);
            }
        }
        
        return array_values($array);
    }
}
