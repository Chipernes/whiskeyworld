<?php

namespace models;

use core\Core;
use core\Utils;

class Brands
{
    protected static string $tableName = 'Brands';

    public static function getBrandById($id)
    {
        $rows = Core::getInstance()->db->select(self::$tableName, '*', ['BrandId' => $id]);

        if (!empty($rows))
            return $rows[0];
        else
            return null;
    }

    public static function getBrands()
    {
        return Core::getInstance()->db->select(self::$tableName);
    }

    public static function addBrand($name)
    {
        Core::getInstance()->db->insert(
            self::$tableName,
            [
                'Name' => $name
            ]
        );
    }

    public static function updateBrand($id, $updatesArray)
    {
        $updatesArray = Utils::filterArray($updatesArray, ['Name']);
        Core::getInstance()->db->update(
            self::$tableName,
            $updatesArray,
            ['BrandId' => $id]
        );
    }

    public static function deleteBrand($conditionArray)
    {
        Core::getInstance()->db->delete(
            self::$tableName,
            $conditionArray
        );
    }
}