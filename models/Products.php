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

        $fieldsList = ['CategoryId', 'Name', 'Type', 'Color', 'SugarContentId', 'BrandId', 'Volume', 'Strength',
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
        $fieldsList = ['CategoryId', 'Name', 'Type', 'Color', 'SugarContentId', 'BrandId', 'Volume', 'Strength',
            'Taste', 'GrapeVarietyId', 'Aging', 'Description', 'Count', 'Price', 'Visibility'];

        $newRow = Utils::filterArray($newRow, $fieldsList);

        Core::getInstance()->db->update(self::$tableName, $newRow, ['ProductId' => $id]);
    }

    public static function getProductById($id)
    {
        $row = Core::getInstance()->db->select(self::$tableName, '*', ['ProductId' => $id]);

        if (!empty($row))
            return $row[0];

        return null;
    }

    public static function getAllProduct(): ?array
    {
        $row = Core::getInstance()->db->select(self::$tableName);

        if (!empty($row))
            return $row;

        return null;
    }

    public static function getProductsByBrandName($brandsNames): ?array
    {
        $productRows = [];

        $brandProducts = [];

        $joinedRows = Core::getInstance()->db->selectJoin(self::$tableName, 'Brands', 'BrandId', ['BrandId', 'Name'], ['BrandId', 'BrandName']);

        foreach ($joinedRows as $joinedRow) {
            if (in_array($joinedRow['BrandName'], $brandsNames)) {
                $products = Core::getInstance()->db->select(self::$tableName, '*', ['BrandId' => $joinedRow['BrandId']]);
                if (!empty($products)) {
                    $brandProducts[$joinedRow['BrandName']] = $products;
                }
            }
        }

        foreach ($brandProducts as $brandProduct) {
            $productRows = array_merge($productRows, $brandProduct);
        }

        if (!empty($productRows)) {
            return $productRows;
        }

        return null;
    }

    public static function getProductsByType($typesNames): ?array
    {
        $productRows = [];

        $brandProducts = [];

        $joinedRows = Core::getInstance()->db->select(self::$tableName);

        foreach ($joinedRows as $joinedRow) {
            if (in_array($joinedRow['Type'], $typesNames)) {
                $products = Core::getInstance()->db->select(self::$tableName, '*', ['Type' => $joinedRow['Type']]);
                if (!empty($products)) {
                    $brandProducts[$joinedRow['Type']] = $products;
                }
            }
        }

        foreach ($brandProducts as $brandProduct) {
            $productRows = array_merge($productRows, $brandProduct);
        }

        if (!empty($productRows)) {
            return $productRows;
        }

        return null;
    }

    public static function getProductsByVolume($typesNames): ?array
    {
        $productRows = [];

        $brandProducts = [];

        $joinedRows = Core::getInstance()->db->select(self::$tableName);

        foreach ($joinedRows as $joinedRow) {
            if (in_array($joinedRow['Volume'], $typesNames)) {
                $products = Core::getInstance()->db->select(self::$tableName, '*', ['Volume' => $joinedRow['Volume']]);
                if (!empty($products)) {
                    $brandProducts[$joinedRow['Volume']] = $products;
                }
            }
        }

        foreach ($brandProducts as $brandProduct) {
            $productRows = array_merge($productRows, $brandProduct);
        }

        if (!empty($productRows)) {
            return $productRows;
        }

        return null;
    }

    public static function getProductsByAging($aging): ?array
    {
        $productRows = [];

        $brandProducts = [];

        $joinedRows = Core::getInstance()->db->select(self::$tableName);

        foreach ($joinedRows as $joinedRow) {
            if (in_array($joinedRow['Aging'], $aging)) {
                $products = Core::getInstance()->db->select(self::$tableName, '*', ['Aging' => $joinedRow['Aging']]);
                if (!empty($products)) {
                    $brandProducts[$joinedRow['Aging']] = $products;
                }
            }
        }

        foreach ($brandProducts as $brandProduct) {
            $productRows = array_merge($productRows, $brandProduct);
        }

        if (!empty($productRows)) {
            return $productRows;
        }

        return null;
    }

    public static function getProductsByCountry($countryNames): ?array
    {
        $productRows = [];

        $brandProducts = [];

        $joinedRows = Core::getInstance()->db->selectJoin(self::$tableName, 'Brands', 'BrandId', ['BrandId', 'Country'], ['BrandId', 'CountryName']);

        foreach ($joinedRows as $joinedRow) {
            if (in_array($joinedRow['CountryName'], $countryNames)) {
                $products = Core::getInstance()->db->select(self::$tableName, '*', ['BrandId' => $joinedRow['BrandId']]);
                if (!empty($products)) {
                    $brandProducts[$joinedRow['CountryName']] = $products;
                }
            }
        }

        foreach ($brandProducts as $brandProduct) {
            $productRows = array_merge($productRows, $brandProduct);
        }

        if (!empty($productRows)) {
            return $productRows;
        }

        return null;
    }

    public static function getJoinedProductWithCategory()
    {
        return Core::getInstance()->db->selectJoin(self::$tableName, 'Categories', 'CategoryId', ['Name'], ['CategoryName']);
    }

    public static function getGroupedProduct($fieldList, $conditionArray, $groupBy)
    {
        return Core::getInstance()->db->selectGroup(self::$tableName, $fieldList, $conditionArray, 'AND', $groupBy);
    }

    public static function getProductsInCategory($categoryId)
    {
        return Core::getInstance()->db->select(self::$tableName, '*', ['CategoryId' => $categoryId]);
    }

    public static function deleteImageFile($id)
    {
        $row = self::getProductById($id);
        $imagePath = 'files/products/' . $row['Image'];

        if (is_file($imagePath))
            unlink($imagePath);
    }

    public static function changeImage($id, $newImagePath)
    {
        self::deleteImageFile($id);

        do {
            $fileName = uniqid() . '.jpg';
            $newPath = "files/products/{$fileName}";
        } while (file_exists($newPath));

        move_uploaded_file($newImagePath, $newPath);

        Core::getInstance()->db->update(self::$tableName,
            ['Image' => $fileName],
            ['ProductId' => $id]
        );
    }
}