<?php

namespace core;

class DB
{
    protected $pdo;

    public function __construct($hostname, $login, $password, $database)
    {
        $this->pdo = new \PDO("mysql: host={$hostname}; dbname={$database}", $login, $password);
    }

    public function select($tableName, $fieldsList = '*', $conditionArray = null, $conditionOperators = 'AND')
    {
        if (is_string($fieldsList))
            $fieldsListString = $fieldsList;
        if (is_array($fieldsList))
            $fieldsListString = implode(', ', $fieldsList);

        $wherePartString = '';
        if (is_array($conditionArray)) {
            $whereParts = [];
            foreach ($conditionArray as $key => $value) {
                $whereParts [] = "{$key} = :{$key}";
            }
            $wherePartString = 'WHERE ' . implode(" $conditionOperators ", $whereParts);
        }

        $res = $this->pdo->prepare("SELECT {$fieldsListString} FROM {$tableName} {$wherePartString}");
        $res->execute($conditionArray);
        return $res->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function selectGroup($tableName, $fieldsList = '*', $conditionArray = null, $conditionOperators = 'AND', $groupBy = null, $orderBy = null)
    {
        if (is_string($fieldsList))
            $fieldsListString = $fieldsList;
        elseif (is_array($fieldsList))
            $fieldsListString = implode(', ', $fieldsList);

        $wherePartString = '';
        if (is_array($conditionArray)) {
            $whereParts = [];
            foreach ($conditionArray as $key => $value) {
                if (strtoupper($value) == 'IS NOT NULL' || strtoupper($value) == 'IS NULL') {
                    $whereParts[] = "{$key} {$value}";
                } else {
                    $whereParts[] = "{$key} = :{$key}";
                }
            }
            $wherePartString = 'WHERE ' . implode(" $conditionOperators ", $whereParts);
        }

        $groupByString = '';
        if (!empty($groupBy)) {
            $groupByString = 'GROUP BY ' . $groupBy;
        }

        $orderByString = '';
        if (!empty($orderBy)) {
            $orderByString = ' ORDER BY ' . implode(', ', $orderBy);
        }

        $res = $this->pdo->prepare("SELECT {$fieldsListString} FROM {$tableName} {$wherePartString} {$groupByString} {$orderByString}");
        $res->execute($conditionArray);
        return $res->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function selectJoin($tableNames, $joinFields, $selectedFields, $asAliases, $groupBy = [], $orderBy = null)
    {
        if (!is_array($tableNames) || !is_array($joinFields) || !is_array($selectedFields) || !is_array($asAliases)) {
            return 'Invalid inputted value';
        }

        $fieldsListString = implode(', ', array_map(function ($selected, $as) {
            return ($as !== null) ? "$selected AS $as" : $selected;
        }, $selectedFields, $asAliases));

        $joinPartString = '';
        for ($i = 0; $i < count($tableNames) - 1; $i++) {
            $joinPartString .= " INNER JOIN {$tableNames[$i + 1]} ON {$tableNames[$i]}.{$joinFields[$i]} = {$tableNames[$i + 1]}.{$joinFields[$i]}";
        }

        $groupByString = '';
        if (!empty($groupBy)) {
            $groupByString = ' GROUP BY ' . implode(', ', $groupBy);
        }

        $orderByString = '';
        if (!empty($orderBy)) {
            $orderByString = ' ORDER BY ' . implode(', ', $orderBy);
        }

        $res = $this->pdo->prepare("SELECT $fieldsListString FROM {$tableNames[0]} $joinPartString $groupByString $orderByString");
        $res->execute();
        return $res->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function selectBetween($tableName, $fieldsList = '*', $conditions = null, $conditionOperators = 'AND')
    {
        if (is_string($fieldsList)) {
            $fieldsListString = $fieldsList;
        } elseif (is_array($fieldsList)) {
            $fieldsListString = implode(', ', $fieldsList);
        } else {
            $fieldsListString = '*';
        }

        $wherePartString = '';
        $conditionsArray = [];
        if (is_array($conditions)) {
            $whereParts = [];
            foreach ($conditions as $key => $value) {
                if (is_array($value) && count($value) === 2) {
                    $minValue = $value[0];
                    $maxValue = $value[1];
                    $whereParts[] = "({$key} >= :min_{$key} AND {$key} <= :max_{$key})";
                    $conditionsArray[":min_{$key}"] = $minValue;
                    $conditionsArray[":max_{$key}"] = $maxValue;
                } else {
                    $whereParts[] = "{$key} = :{$key}";
                    $conditionsArray[":{$key}"] = $value;
                }
            }
            $wherePartString = 'WHERE ' . implode(" $conditionOperators ", $whereParts);
        }

        $query = "SELECT {$fieldsListString} FROM {$tableName} {$wherePartString}";
        $res = $this->pdo->prepare($query);

        $placeholdersCount = substr_count($query, ':');
        $boundParamsCount = count($conditionsArray);

        if ($placeholdersCount !== $boundParamsCount) {
            throw new \RuntimeException("Invalid number of bound variables. Expected {$placeholdersCount}, got {$boundParamsCount}.");
        }

        $res->execute($conditionsArray);
        return $res->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function update($tableName, $newValuesArray, $conditionArray)
    {
        $setPart = [];
        $paramsArray = [];
        foreach ($newValuesArray as $key => $value) {
            $setPart [] = "{$key} = :set{$key}";
            $paramsArray['set' . $key] = $value;
        }

        $setPartString = implode(', ', $setPart);

        $whereParts = [];
        foreach ($conditionArray as $key => $value) {
            $whereParts [] = "{$key} = :{$key}";
            $paramsArray[$key] = $value;
        }

        $wherePartString = "WHERE " . implode(' AND ', $whereParts);
        $res = $this->pdo->prepare("UPDATE {$tableName} SET {$setPartString} {$wherePartString}");
        $res->execute($paramsArray);
    }

    public function insert($tableName, $newRowArray)
    {
        $fieldsArray = array_keys($newRowArray);
        $fieldsListString = implode(', ', $fieldsArray);

        $paramsArray = [];
        foreach ($newRowArray as $key => $value) {
            $paramsArray [] = ':' . $key;
        }

        $valuesListString = implode(', ', $paramsArray);
        $res = $this->pdo->prepare("INSERT INTO {$tableName} ($fieldsListString) VALUES ($valuesListString)");
        $res->execute($newRowArray);
    }

    public function delete($tableName, $conditionArray)
    {
        $whereParts = [];
        foreach ($conditionArray as $key => $value) {
            $whereParts [] = "{$key} = :{$key}";
        }

        $wherePartString = "WHERE " . implode(' AND ', $whereParts);

        $res = $this->pdo->prepare("DELETE FROM {$tableName} {$wherePartString}");
        $res->execute($conditionArray);
    }
}