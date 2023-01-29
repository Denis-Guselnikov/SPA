<?php

$errMsg = '';

// Создание записи
if ($_SESSION['id'] and $_SERVER['REQUEST_METHOD'] === 'POST' and isset($_POST['add_post'])) {
    $sum = $_POST['sum'];
    $status = $_POST['status'];
    $description = $_POST['description'];

    if ($sum === '' or $status === '' or $description === '') {
        $errMsg = 'Не все поля заполнены!!!';
    } else {
        $post = [
            'user_id' => $_SESSION['id'],
            'amount' => $sum,
            'status' => $status,
            'description' => $description
        ];

        $add_post = insert('operation', $post);
        header('location: ' . BASE_URL);
    }
}

// Удаление записи
if($_SERVER['REQUEST_METHOD'] === 'GET' and isset($_GET['delete_id'])){
    $id = $_GET['delete_id'];
    delete('operation', $id);
    header('location: ' . BASE_URL);
}
