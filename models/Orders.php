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

    public static function getGroupedOrderStatuses(): ?array
    {
        return Core::getInstance()->db->selectGroup(self::$tableName, 'StatusId, COUNT(StatusId) AS StatusCount', null, 'AND', 'StatusId');
    }

    public static function getGroupedOrdersByDateAndPrice()
    {
        return Core::getInstance()->db->selectGroup(self::$tableName, 'Date, SUM(TotalPrice) AS TotalPrice', null, 'AND', 'Date');
    }

    public static function getJoinedOrdersWithUsers()
    {
        return Core::getInstance()->db->selectJoin(['Orders', 'Users'], ['UserId'], ['Users.Firstname', 'Users.Lastname', 'Users.PhoneNumber', 'Orders.*'], ['Firstname', 'Lastname', 'PhoneNumber', null], [], ['OrderId']);
    }

    public static function getJoinedOrdersWithStatuses()
    {
        return Core::getInstance()->db->selectJoin(['Orders', 'Statuses'], ['StatusId'], ['Statuses.Name', 'Orders.*'], ['StatusName', null], [], ['OrderId']);
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
        var_dump($userId, $date);
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