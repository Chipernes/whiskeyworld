<?php

namespace models;

use core\Core;

class Genders
{
    protected static string $tableName = 'Genders';

    public static function getAllGenders()
    {
        return Core::getInstance()->db->select(self::$tableName);
    }
}