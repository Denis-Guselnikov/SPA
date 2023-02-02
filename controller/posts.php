<?php

// Создание записи с Ajax
if ($_SESSION['id'] && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $sum = trim($_POST['amount']);
    $status = trim($_POST['status']);
    $description = htmlspecialchars(trim($_POST['description']), ENT_QUOTES);
    if ($sum === "" or $status === '' or $description === '') {
        echo 1;
        exit();
    } elseif ($_POST['status'] != 'income' && $_POST['status'] != 'expense') {
        echo 2;
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
