<?php

namespace app\components\widgets;

class Menu extends \dmstr\widgets\Menu
{
    public function __construct($config = array())
    {
        parent::__construct($config);
        
        $this->linkTemplate = '<a href="{url}">{icon} {label}{badge}</a>';
    }
    
    public function renderItem($item)
    {
        $html = parent::renderItem($item);
        $badge = array_key_exists('badge', $item) && intval($item['badge']) > 0 
                ? sprintf('<span class="badge pull-right bg-green">%s</span>', $item['badge']) 
                : '';
        
        return str_replace('{badge}', $badge, $html);
    }
}
