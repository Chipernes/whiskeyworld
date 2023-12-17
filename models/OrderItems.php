<?php

namespace models;

use core\Core;
use core\Utils;

class OrderItems
{
    protected static string $tableName = 'OrderItems';

    public static function getOrderItemById($id)
    {
        $rows = Core::getInstance()->db->select(self::$tableName, '*', ['OrderItemId' => $id]);

        if (!empty($rows))
            return $rows[0];
        else
            return null;
    }

    public static function getOrderItemByOrderId($id)
    {
        $rows = Core::getInstance()->db->select(self::$tableName, '*', ['OrderId' => $id]);

        if (!empty($rows))
            return $rows;
        else
            return null;
    }

    public static function getOrderItems()
    {
        return Core::getInstance()->db->select(self::$tableName);
    }

    public static function getTotalPrice()
    {
        return Core::getInstance()->db->selectGroup(self::$tableName, 'OrderId, SUM(`Count` * `Price`) AS TotalPrice', null, 'AND', 'OrderId');
    }

    public static function addOrderItem($orderId, $productId, $count, $price)
    {
        Core::getInstance()->db->insert(
            self::$tableName,
            [
                'OrderId' => $orderId,
                'ProductId' => $productId,
                'Count' => $count,
                'Price' => $price,
            ]
        );
    }

    public static function updateOrderItem($id, $updatesArray)
    {
        $updatesArray = Utils::filterArray($updatesArray, ['OrderId', 'ProductId', 'Count', 'Price']);
        Core::getInstance()->db->update(
            self::$tableName,
            $updatesArray,
            ['OrderItemId' => $id]
        );
    }

    public static function deleteOrderItem($id)
    {
        Core::getInstance()->db->delete(self::$tableName, ['OrderItemId' => $id]);
    }
}