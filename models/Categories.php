<?php

namespace models;

use core\Core;

class Categories
{
    protected static $tableName = 'Categories';

    public static function addCategory($categoryName, $imagePath)
    {
        do {
            $fileName = uniqid() . '.jpg';
            $newPath = "files/categories/{$fileName}";
        } while (file_exists($newPath));

        move_uploaded_file($imagePath, $newPath);

        Core::getInstance()->db->insert(self::$tableName,
            [
                'Name' => $categoryName,
                'Image' => $fileName
            ]);
    }

    public static function deleteImageFile($id)
    {
        $row = self::getCategoryById($id);
        $imagePath = 'files/categories/' . $row['Image'];

        if (is_file($imagePath))
            unlink($imagePath);
    }

    public static function changeImage($id, $newImagePath)
    {
        self::deleteImageFile($id);

        do {
            $fileName = uniqid() . '.jpg';
            $newPath = "files/categories/{$fileName}";
        } while (file_exists($newPath));

        move_uploaded_file($newImagePath, $newPath);

        Core::getInstance()->db->update(self::$tableName,
            ['Image' => $fileName],
            ['AlcoholId' => $id]
        );
    }

    public static function getCategoryById($id)
    {
        $rows = Core::getInstance()->db->select(self::$tableName, '*', ['CategoryId' => $id]);

        if (!empty($rows))
            return $rows[0];
        else
            return null;
    }

    public static function getGroupedCategories($fieldList, $conditionArray, $groupBy)
    {
        return Core::getInstance()->db->selectGroup(self::$tableName, $fieldList, $conditionArray, 'AND', $groupBy);
    }

    public static function getJoinedCategory($tableNames, $joinFields, $selectedFields, $asAliases, $groupBy = [])
    {
        return Core::getInstance()->db->selectJoin($tableNames, $joinFields, $selectedFields, $asAliases, $groupBy);
    }

    public static function deleteCategory($id)
    {
        self::deleteImageFile($id);
        Core::getInstance()->db->delete(self::$tableName, ['CategoryId' => $id]);
    }

    public static function updateCategory($id, $newName)
    {
        Core::getInstance()->db->update(self::$tableName,
            ['Name' => $newName],
            ['CategoryId' => $id]);
    }

    public static function getCategories()
    {
        return Core::getInstance()->db->select(self::$tableName);
    }
}