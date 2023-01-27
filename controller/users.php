<?php
include "function.php";
include "path.php";

$errMsg = '';

// Register
if ($_SERVER['REQUEST_METHOD'] === 'POST' and isset($_POST['button-reg'])) {
    $login = $_POST['login'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];

    if ($login === '' and $password1 === '') {
        $errMsg = 'Не все поля заполнены!';
    } else {
        $pass = password_hash($password1, PASSWORD_DEFAULT);
        $post = [
            'username' => $login,
            'password_hash' => $pass
        ];

        $id = insert('users', $post);
        $user = selectOne('users', ['id' => $id]);

        $_SESSION['id'] = $user['id'];
        $_SESSION['login'] = $user['username'];
        header('location: ' . BASE_URL);
    }
}

// Login
if ($_SERVER['REQUEST_METHOD'] === 'POST' and isset($_POST['button-log'])) {

    $login = $_POST['login'];
    $password = $_POST['password'];

    if ($login === '' and $password === '') {
        $errMsg= 'Не все поля заполнены!';
    } else {
        $existLogin = selectOne('users', ['username' => $login ]);
//        tt($existLogin);
//        exit();
        if ($existLogin and password_verify($password, $existLogin['password_hash'])) {
            $_SESSION['id'] = $existLogin['id'];
            $_SESSION['login'] = $existLogin['username'];
            header('location: ' . BASE_URL);
        } else {
            $errMsg = 'Ошибка авторизации!';
        }
    }

}

