<?php

namespace models;

use core\Core;
use core\Utils;

class SugarContents
{
    protected static string $tableName = 'SugarContents';

    public static function getSugarContentById($id)
    {
        $rows = Core::getInstance()->db->select(self::$tableName, '*', ['SugarContentId' => $id]);

        if (!empty($rows))
            return $rows[0];
        else
            return null;
    }

    public static function getSugarContents()
    {
        return Core::getInstance()->db->select(self::$tableName);
    }

    public static function addSugarContent($name)
    {
        Core::getInstance()->db->insert(
            self::$tableName,
            [
                'Name' => $name,
            ]
        );
    }

    public static function getSugarContentByName($name)
    {
        $rows = Core::getInstance()->db->select(self::$tableName, '*', ['Name' => $name]);

        if (!empty($rows))
            return $rows[0];
        else
            return null;
    }

    public static function updateSugarContent($id, $updatesArray)
    {
        $updatesArray = Utils::filterArray($updatesArray, ['Name']);
        Core::getInstance()->db->update(
            self::$tableName,
            $updatesArray,
            ['SugarContentId' => $id]
        );
    }

    public static function deleteSugarContent($id)
    {
        Core::getInstance()->db->delete(self::$tableName, ['SugarContentId' => $id]);
    }
}