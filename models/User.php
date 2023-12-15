<?php

namespace models;

use core\Core;
use core\Utils;

class User
{
    protected static $tableName = 'Users';

    public static function selectUser($fieldsList = '*', $conditionArray = null)
    {
        return
            Core::getInstance()->db->select(
                self::$tableName,
                $fieldsList,
                $conditionArray,
            );
    }

    public static function addUser($email, $login, $password, $firstname, $lastname, $birthdate = null, $genderId = null)
    {
        Core::getInstance()->db->insert(
            self::$tableName,
            [
                'Email' => $email,
                'Login' => $login,
                'Password' => self::hashPassword($password),
                'Firstname' => $firstname,
                'Lastname' => $lastname,
                'BirthDate' => $birthdate,
                'GenderId' => $genderId
            ]
        );
    }

    public static function hashPassword($password): string
    {
        return md5($password);
    }

    public static function updateUser($id, $updatesArray)
    {
        //$updatesArray = Utils::filterArray($updatesArray, ['Email', 'Login', 'Password', 'Firstname', 'Lastname', 'BirthDate', 'GenderId']);
        Core::getInstance()->db->update(
            self::$tableName,
            $updatesArray,
            ['UserId' => $id]
        );

        self::logoutUser();
        $updatedCurrentUser = self::getAllUsers()[$id - 1];
        self::authenticatedUser($updatedCurrentUser);
    }

    public static function setAdminRights($id)
    {
        Core::getInstance()->db->update(
            self::$tableName,
            ['AccessLevel' => 10],
            ['UserId' => $id],
        );
    }

    public static function deleteAdminRights($id)
    {
        Core::getInstance()->db->update(
            self::$tableName,
            ['AccessLevel' => 1],
            ['UserId' => $id],
        );
    }

    public static function deleteUser($conditionArray)
    {
        Core::getInstance()->db->delete(
            self::$tableName,
            $conditionArray
        );
    }

    public static function isUserExists($field, $value): bool
    {
        $user = Core::getInstance()->db->select(self::$tableName, '*', [$field => $value]);

        return !empty($user);
    }

    public static function verifyUser($login, $password): bool
    {
        $user = Core::getInstance()->db->select(self::$tableName, '*',
            [
                'Login' => $login,
                'Password' => $password,
            ]);

        return !empty($user);
    }

    public static function getAllUsers(): ?array
    {
        $user = Core::getInstance()->db->select(self::$tableName);

        if (!empty($user))
            return $user;

        return null;
    }

    public static function getGroupedGenders(): ?array
    {
        return Core::getInstance()->db->selectGroup(self::$tableName, 'GenderId, COUNT(GenderId) AS GenderCount', null, 'AND', 'GenderId');
    }

    public static function getUserByLoginAndPassword($login, $password)
    {
        $user = Core::getInstance()->db->select(self::$tableName, '*',
            [
                'Login' => $login,
                'Password' => self::hashPassword($password),
            ]);

        if (!empty($user))
            return $user[0];

        return null;
    }

    public static function authenticatedUser($user)
    {
        $_SESSION['user'] = $user;
    }

    public static function logoutUser()
    {
        unset($_SESSION['user']);
        Cart::resetCart();
    }

    public static function isUserAuthenticated(): bool
    {
        return isset($_SESSION['user']);
    }

    public static function getCurrentAuthenticatedUser()
    {
        return $_SESSION['user'];
    }

    public static function isAdmin(): bool
    {
        $user = self::getCurrentAuthenticatedUser();
        return $user['AccessLevel'] == 10;
    }
}