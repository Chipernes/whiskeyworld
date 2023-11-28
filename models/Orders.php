<?php

namespace models;

use core\Core;
use core\Utils;

class Orders
{
    protected static string $tableName = 'Orders';

    public static function getOrderById($id)
    {
        $rows = Core::getInstance()->db->select(self::$tableName, '*', ['OrderId' => $id]);

        if (!empty($rows))
            return $rows[0];
        else
            return null;
    }

    public static function getOrders()
    {
        return Core::getInstance()->db->select(self::$tableName);
    }

    public static function getaLastOrderId()
    {
        $rows = Core::getInstance()->db->select(self::$tableName, 'MAX(OrderId) As LastOrderId');

        if (!empty($rows))
            return $rows[0]['LastOrderId'];
        else
            return null;
    }

    public static function addOrder($userId, $date)
    {
        Core::getInstance()->db->insert(
            self::$tableName,
            [
                'UserId' => $userId,
                'Date' => $date,
            ]
        );
    }

    public static function updateOrderItem($id, $updatesArray)
    {
        $updatesArray = Utils::filterArray($updatesArray, ['UserId', 'Date']);
        Core::getInstance()->db->update(
            self::$tableName,
            $updatesArray,
            ['OrderId' => $id]
        );
    }

    public static function deleteOrder($id)
    {
        Core::getInstance()->db->delete(self::$tableName, ['OrderId' => $id]);
    }
}