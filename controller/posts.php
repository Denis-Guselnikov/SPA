<?php

$errMsg = '';

// Создание записи с Ajax
if ($_SESSION['id'] and $_SERVER['REQUEST_METHOD'] === 'POST') {
    $sum = $_POST['amount'];
    $status = $_POST['status'];
    $description = $_POST['description'];

    if ($sum === "" or $status === '' or $description === '') {
        $errMsg = 'Не все поля заполнены!!!';
    } else {
        $post = [
            'user_id' => $_SESSION['id'],
            'amount' => $sum,
            'status' => $status,
            'description' => $description
        ];

        insert('operation', $post);
    }
}

// Удаление записи Ajax
if(isset($_GET["id"])) {
    $id = $_GET["id"];
    delete('operation', $id);
    header('location: ' . BASE_URL);
}
