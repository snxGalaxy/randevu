<?php

namespace app\components\helpers;

use Yii;

class Html extends \yii\helpers\Html
{
    public static function pageActionLink($icon, $name, $url, $confirm = null, $isPost = true)
    {
        $options = ['class' => 'btn btn-app'];
        
        if ($confirm) {
            $options['data']['confirm'] = $confirm;
        }
        
        if ($isPost) {
            $options['data'] = ['method' => 'post'];
        }
        
        return self::a(sprintf('<i class="fa %s"></i>%s', $icon, $name), $url, $options);
    }
    
    public static function pageActionModal($icon, $name, $target)
    {
        return self::a(sprintf('<i class="fa %s"></i>%s', $icon, $name), '#', ['class' => 'btn btn-app', 'data-toggle' => 'modal', 'data-target' => $target]);
    }
    
    public static function actionDropdown($items)
    {
        return empty($items) ? '' : Html::tag('div', implode('', [
            Html::button('<i class="fa fa-caret-down"></i>', ['class' => 'btn btn-xs btn-flat btn-default', 'data-toggle' => 'dropdown']),
            Html::tag('ul', sprintf('<li>%s</li>', implode('</li><li>', $items)), ['class' => 'dropdown-menu', 'role' => 'menu', 'style' => 'left: auto; right: 0;']),
        ]), ['class' => 'btn-group']);
    }
    
    public static function actionDropdownLink($icon, $name, $url, $confirm = null)
    {
        $options = ['data' => ['method' => 'post']];
        
        if ($confirm) {
            $options['data']['confirm'] = $confirm;
        }
        
        return self::a(sprintf('<i class="fa %s"></i> %s', $icon, $name), $url, $options);
    }
    
    public static function actionDropdownModal($icon, $name, $target)
    {
        return self::a(sprintf('<i class="fa %s"></i> %s', $icon, $name), '#', ['data-toggle' => 'modal', 'data-target' => $target]);
    }
    
    public static function modalSubmitButton()
    {
        return self::submitButton(Yii::t('app/common', 'Submit'), ['class' => 'btn btn-primary', 'data' => ['method' => 'post']]);
    }
    
    public static function modalActionButton($name, $url, $class)
    {
        return self::a($name, $url, ['class' => 'btn ' . $class, 'data-dismiss' => 'modal', 'data' => ['method' => 'post']]);
    }
    
    public static function modalCancelButton($class = 'btn-default')
    {
        return self::button(Yii::t('app/common', 'Cancel'), ['class' => 'btn ' . $class, 'data-dismiss' => 'modal']);
    }
    
//    public static function actionLink($icon, $name, $class, $url, $tooltip = 'top')
//    {
//        return self::actionLinkHtml($icon, $name, $class, false, $url, $tooltip);
//    }
//    
//    public static function actionLinkModal($icon, $name, $class, $target, $tooltip = 'top')
//    {
//        return self::actionLinkHtml($icon, $name, $class, $target, '#', $tooltip);
//    }
//    
//    private static function actionLinkHtml($icon, $name, $class, $target, $url, $tooltip)
//    {
//        $text = sprintf('<i class="fa %s"></i>%s', $icon, $tooltip ? '' : ' ' . $name);
//        $options = [
//            'class' => $class,
//        ];
//        
//        if ($target) {
//            $options['data-toggle'] = 'modal';
//            $options['data-target'] = $target;
////            $options['onclick'] = '$("[data-toggle=\"tooltip\"]").tooltip("hide");';
//        }
//        
//        if ($url != '#') {
//            $options['data'] = ['method' => 'post'];
//        }
//        
//        $html = self::a($text, $url, $options);
//        
//        if ($tooltip) {
//            $html = self::tag('span', $html, [
//                'data-toggle' => 'tooltip',
//                'data-original-title' => $name,
//                'data-placement' => $tooltip,
//            ]);
//        }
//        
//        return self::tag('span', $html, ['style' => 'margin-right: 8px;']);
//    }
}
