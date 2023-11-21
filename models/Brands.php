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

    public static function addBrand($name, $country)
    {
        Core::getInstance()->db->insert(
            self::$tableName,
            [
                'Name' => $name,
                'Country' => $country
            ]
        );
    }

    public static function getBrandByName($name)
    {
        $rows = Core::getInstance()->db->select(self::$tableName, '*', ['Name' => $name]);

        if (!empty($rows))
            return $rows[0];
        else
            return null;
    }

    public static function updateBrand($id, $updatesArray)
    {
        $updatesArray = Utils::filterArray($updatesArray, ['Name', 'Country']);
        Core::getInstance()->db->update(
            self::$tableName,
            $updatesArray,
            ['BrandId' => $id]
        );
    }

    public static function deleteBrand($id)
    {
            Core::getInstance()->db->delete(self::$tableName, ['BrandId' => $id]);
    }
}