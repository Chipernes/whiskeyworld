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

    public function selectGroup($tableName, $fieldsList = '*', $conditionArray = null, $conditionOperators = 'AND', $groupBy = null)
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

        $res = $this->pdo->prepare("SELECT {$fieldsListString} FROM {$tableName} {$wherePartString} {$groupByString}");
        $res->execute($conditionArray);
        return $res->fetchAll(\PDO::FETCH_ASSOC);
    }


    /*public function selectJoin($firstTableName, $secondTableName, $joinField, $selectedName, $asName)
    {
        if (is_string('*'))
            $fieldsListString = "$secondTableName.$selectedName AS $asName, $firstTableName.*";

        $joinPartString = 'INNER JOIN ' . $secondTableName . ' ON' . " $firstTableName.$joinField = $secondTableName.$joinField";
        $res = $this->pdo->prepare("SELECT {$fieldsListString} FROM {$firstTableName} {$joinPartString}");
        $res->execute();
        return $res->fetchAll(\PDO::FETCH_ASSOC);
    }*/
    public function selectJoin($firstTableName, $secondTableName, $joinField, $selectedNames, $asNames)
    {
        if (!is_array($selectedNames) || !is_array($asNames) || count($selectedNames) !== count($asNames)) {
            return 'Invalid';
        }

        $fieldsListString = '';
        foreach ($selectedNames as $key => $selectedName) {
            $fieldsListString .= "$secondTableName.$selectedName AS {$asNames[$key]}, ";
        }
        $fieldsListString .= "$firstTableName.*";

        $joinPartString = 'INNER JOIN ' . $secondTableName . ' ON ' . "$firstTableName.$joinField = $secondTableName.$joinField";

        $res = $this->pdo->prepare("SELECT {$fieldsListString} FROM {$firstTableName} {$joinPartString}");
        $res->execute();
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