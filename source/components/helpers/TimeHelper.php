<?php

namespace app\components\helpers;

class TimeHelper
{
    const FORMAT_TIMESTAMP = 'yyyy-MM-dd HH:mm:ss';
    const FORMAT_PRETTY = 'd M Y H:i';
    
    public static function format($dateString, $format)
    {
        return date($format, strtotime($dateString));
    }
}
