<?php

$driver = 'mysql';
$host = 'mysql';
$db_name = 'spa-php';
$db_user = 'root';
$db_pass = '12345';
$charset = 'utf8';
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

try {
    $pdo = new PDO(
      "$driver:host=$host;dbname=$db_name; charset=$charset", $db_user, $db_pass, $options
    );
} catch (PDOException $i) {
    die('Ошибка подключения к БД!');
}