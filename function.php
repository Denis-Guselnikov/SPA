<?php
session_start();
include "connect.php";

function tt($value)
{
    echo '<pre>';
    print_r($value);
    echo '</pre>';
}

// запись в таблицу
function insert($table, $params)
{
    global $pdo;
    $i = 0;
    $coll = '';
    $mask = '';
    foreach ($params as $key => $value) {
        if ($i === 0) {
            $coll .= "`" . "$key" . "`";
            $mask .= "'" . "$value" . "'";
        } else {
            $coll .= "," . " `" . "$key" . "`";
            $mask .= ", '" . "$value" . "'";
        }
        $i++;
    }
    $sql = "INSERT INTO $table ($coll) VALUES ($mask)";
    $query = $pdo->prepare($sql);
    $query->execute();
    return $pdo->lastInsertId();
}

// данные 1 строки из таблицы
function selectOne($table, $params = [])
{
    global $pdo;
    $sql = "SELECT * FROM $table";

    if (!empty($params)) {
        $count = 0;
        foreach ($params as $key => $value) {
            if (!is_numeric($value)) {
                $value = "'" . $value . "'";
            }
            if ($count === 0) {
                $sql = $sql . " WHERE $key = $value";
            } else {
                $sql = $sql . " AND $key = $value";
            }
            $count++;
        }
    }
    $query = $pdo->prepare($sql);
    $query->execute();
    return $query->fetch();
}

// данные 1 таблицы
function selectAll($table, $params = [])
{
    global $pdo;
    $sql = "SELECT * FROM $table ORDER BY id DESC LIMIT 10";

    if (!empty($params)) {
        $count = 0;
        foreach ($params as $key => $value) {
            if (!is_numeric($value)) {
                $value = "'" . $value . "'";
            }
            if ($count === 0) {
                $sql = $sql . " WHERE $key = $value";
            } else {
                $sql = $sql . " AND $key = $value";
            }
            $count++;
        }
    }
    $query = $pdo->prepare($sql);
    $query->execute();
    return $query->fetchAll();
}

function getSumIncome()
{
    global $pdo;
    $sql = "SELECT SUM(amount) FROM operation WHERE status='income'";
    $query = $pdo->prepare($sql);
    $query->execute();
    return $query->fetch();
}

function getSumExpense()
{
    global $pdo;
    $sql = "SELECT SUM(amount) FROM operation WHERE status='expense'";
    $query = $pdo->prepare($sql);
    $query->execute();
    return $query->fetch();
}

function getResult($arr1, $arr2)
{
    return $arr1 - $arr2;
}
