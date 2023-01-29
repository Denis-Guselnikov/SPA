<?php

$driver = 'mysql';
$host = 'mysql';
$db_name = 'spa';
$db_user = 'spa';
$db_pass = 'spa';
$charset = 'utf8';
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];

try {
    $pdo = new PDO(
      "$driver:host=$host;dbname=$db_name; charset=$charset", $db_user, $db_pass, $options
    );
} catch (PDOException $i) {
    die('Ошибка подключения к БД!');
}