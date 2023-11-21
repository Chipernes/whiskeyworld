<?php

namespace models;

use core\Core;
use core\Utils;

class GrapeVarieties
{
    protected static string $tableName = 'GrapeVarieties';

    public static function getGrapeVarietyById($id)
    {
        $rows = Core::getInstance()->db->select(self::$tableName, '*', ['GrapeVarietyId' => $id]);

        if (!empty($rows))
            return $rows[0];
        else
            return null;
    }

    public static function getGrapeVarietyByName($name)
    {
        $rows = Core::getInstance()->db->select(self::$tableName, '*', ['Name' => $name]);

        if (!empty($rows))
            return $rows[0];
        else
            return null;
    }

    public static function getGrapeVarieties()
    {
        return Core::getInstance()->db->select(self::$tableName);
    }

    public static function addGrapeVariety($name)
    {
        Core::getInstance()->db->insert(
            self::$tableName,
            [
                'Name' => $name
            ]
        );
    }

    public static function updateGrapeVariety($id, $updatesArray)
    {
        $updatesArray = Utils::filterArray($updatesArray, ['Name']);
        Core::getInstance()->db->update(
            self::$tableName,
            $updatesArray,
            ['GrapeVarietyId' => $id]
        );
    }

    public static function deleteGrapeVariety($id)
    {
        Core::getInstance()->db->delete(self::$tableName, ['GrapeVarietyId' => $id]);
    }
}