<?php

// Удаление записи с Ajax
if(isset($_GET["id"])) {
$id = $_GET["id"];
delete('operation', $id);
$income = getSumIncome();
$expense = getSumExpense();
$result = array_map('getResult', $income, $expense);
$array = [$income, $expense, $result];
echo json_encode($array);
die();
}
