<?php

namespace models;

use core\Core;

class Statuses
{
    protected static string $tableName = 'Statuses';


    public static function getStatuses()
    {
        return Core::getInstance()->db->select(self::$tableName);
    }
}
