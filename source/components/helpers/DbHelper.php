<?php

namespace app\components\helpers;

use Yii;

class DbHelper
{
    /**
     * Enable or disable foreign key checks
     * @param boolean $isEnabled
     * @return integer Affected rows count
     */
    public static function foreignKeyChecks($isEnabled)
    {
        return Yii::$app->db->createCommand(sprintf('SET FOREIGN_KEY_CHECKS = %d', $isEnabled ? 1 : 0))->execute();
    }
    
    /**
     * Inserts data into single-column tables ignoring/skipping duplicates
     * @param string $table
     * @param string $column
     * @param array $rows
     * @param boolean $isIgnoreDuplicates
     * @return integer Affected rows count
     */
    public static function batchInsert($table, $column, $rows, $isIgnoreDuplicates = true)
    {
        foreach ($rows as &$r) {
            $r = [$r];
        }
        
        $command = Yii::$app->db->createCommand()->batchInsert($table, [$column], $rows);
        
        if ($isIgnoreDuplicates) {
            $command->setSql($command->getSql() . sprintf(' ON DUPLICATE KEY UPDATE %1$s = %1$s', $column));
        }
        
        return $command->execute();
    }
    
    /**
     * Inserts record into table ignoring/skipping duplicates
     * @param string $table
     * @param array $columns
     * @param boolean $isIgnoreDuplicates
     * @return integer Affected rows count
     */
    public static function insert($table, $columns, $isIgnoreDuplicates = true)
    {
        $params = null;
        $sql = Yii::$app->db->queryBuilder->insert($table, $columns, $params);

        if ($isIgnoreDuplicates) {
            $update = [];
            
            foreach ($columns as $key => $value) {
                array_push($update, sprintf('%1$s = %1$s', $key));
            }
            
            $sql .= sprintf(' ON DUPLICATE KEY UPDATE %s', implode(', ', $update));
        }
        
        return Yii::$app->db->createCommand($sql, $params)->execute();
    }
}
