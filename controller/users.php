<?php
include "function.php";
include "path.php";

$errMsg = '';

// Регистрация
if ($_SERVER['REQUEST_METHOD'] === 'POST' and isset($_POST['button-reg'])) {
    $login = trim($_POST['login']);
    $password1 = trim($_POST['password1']);
    $password2 = trim($_POST['password2']);

    if ($login === '' and $password1 === '') {
        $errMsg = 'Не все поля заполнены!';
    } elseif (mb_strlen($login) <= 3) {
        $errMsg = 'Логин не может быть короче 3 символов';
    } elseif (!preg_match("/^[a-zA-Z0-9]+$/", $login)) {
        $errMsg = 'Только латинские цыфры и буквы!';
    } elseif ($password1 != $password2) {
        $errMsg = 'Пароли не совпадают!';
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

// Авторизация
if ($_SERVER['REQUEST_METHOD'] === 'POST' and isset($_POST['button-log'])) {

    $login = trim($_POST['login']);
    $password = trim($_POST['password']);

    if ($login === '' and $password === '') {
        $errMsg= 'Не все поля заполнены!';
    } elseif (!preg_match("/^[a-zA-Z0-9]+$/", $login)) {
        $errMsg = 'Только латинские цыфры и буквы!';
    } else {
        $existLogin = selectOne('users', ['username' => $login ]);
        if ($existLogin and password_verify($password, $existLogin['password_hash'])) {
            $_SESSION['id'] = $existLogin['id'];
            $_SESSION['login'] = $existLogin['username'];
            header('location: ' . BASE_URL);
        } else {
            $errMsg = 'Ошибка авторизации!';
        }
    }
}
