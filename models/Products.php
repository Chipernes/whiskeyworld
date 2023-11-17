<?php

namespace models;

use core\Core;
use core\Utils;

class Products
{
    protected static $tableName = 'Products';

    public static function addProduct($row, $imagePath)
    {
        do {
            $fileName = uniqid() . '.jpg';
            $newPath = "files/products/{$fileName}";
        } while (file_exists($newPath));

        move_uploaded_file($imagePath, $newPath);

        $fieldsList = ['CategoryId', 'Name', 'Type', 'Color', 'BrandId', 'Volume', 'Strength',
            'Taste', 'GrapeVarietyId', 'Aging', 'Description', 'Count', 'Price', 'Visibility', 'Image'];

        $row += ['Image' => $fileName];
        $row = Utils::filterArray($row, $fieldsList);

        Core::getInstance()->db->insert(self::$tableName, $row);
    }

    public static function deleteProduct($id)
    {
        Core::getInstance()->db->delete(self::$tableName, ['ProductId' => $id]);
    }

    public static function updateProduct($id, $newRow)
    {
        $fieldsList = ['Name', 'Type', 'Color', 'Volume', 'Strength',
            'Country', 'Taste', 'Aging', 'GrapeVariety', 'Image', 'Visible'];

        $row = Utils::filterArray($newRow, $fieldsList);

        Core::getInstance()->db->update(self::$tableName, $newRow, ['ProductId' => $id]);
    }

    public static function getProductById($id)
    {
        $row = Core::getInstance()->db->select(self::$tableName, '*', ['ProductId' => $id]);

        if (!empty($row))
            return $row[0];

        return null;
    }

    public static function getProductsInCategory($categoryId)
    {
        return Core::getInstance()->db->select(self::$tableName, '*', ['CategoryId' => $categoryId]);
    }
}