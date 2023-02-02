<?php

// Создание записи с Ajax
if ($_SESSION['id'] and $_SERVER['REQUEST_METHOD'] === 'POST') {
    $sum = trim($_POST['amount']);
    $status = trim($_POST['status']);
    $description = htmlspecialchars(trim($_POST['description']));
    if ($sum === "" or $status === '' or $description === '') {
        echo 1;
        exit();
    } else {
        $post = [
            'user_id' => $_SESSION['id'],
            'amount' => $sum,
            'status' => $status,
            'description' => $description
        ];
        $add_post = insert('operation', $post);
        $income = getSumIncome();
        $expense = getSumExpense();
        $result = array_map('getResult', $income, $expense);
        $array = [$add_post, $income, $expense, $result];
        echo json_encode($array);
        die();
    }
}

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
