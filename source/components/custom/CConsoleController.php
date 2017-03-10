<?php

namespace app\components\custom;

use Yii;
use yii\base\InlineAction;
use yii\console\Controller;
use yii\helpers\Console;

class CConsoleController extends Controller
{
    /**
     * @inheritdoc
     */
    public function stdout($string)
    {
        $result = call_user_func_array('parent::stdout', func_get_args());
        parent::stdout(PHP_EOL);
        
        return $result;
    }
    
    /**
     * @inheritdoc
     */
    public function stderr($string)
    {
        $result = call_user_func_array('parent::stderr', func_get_args());
        parent::stderr(PHP_EOL);
        
        return $result;
    }
    
    /**
     * @param InlineAction $action
     * @return boolean
     */
    public function beforeAction($action)
    {
        $this->stdout(sprintf('Welcome to %s [v.%s]', Yii::$app->name, Yii::$app->version), Console::BG_BLUE);
        
        return parent::beforeAction($action);
    }
    
    /**
     * @param InlineAction $action
     * @param mixed $result
     * @return boolean
     */
    public function afterAction($action, $result)
    {
        switch ($result) {
            case self::EXIT_CODE_NORMAL:
                $this->stdout('Command ended successfully', Console::BG_GREEN);
                break;
            case self::EXIT_CODE_ERROR:
                $this->stdout('Command ended with errors', Console::BG_RED);
                break;
            default:
                $this->stdout('Command ended', Console::BG_BLUE);
                break;
        }
        
        return parent::afterAction($action, $result);
    }
}
