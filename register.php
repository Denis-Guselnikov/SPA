<?php
include "controller/users.php";
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <?php include "include/head.php"; ?>
    <title>Регистрация</title>
</head>
<body>
<?php include "include/header.php"; ?>

<div class="container register">
    <!-- Форма START -->
    <form class="row justify-content-md-center" method="post" action="register.php">
        <h2>Регистрация</h2>
        <div class="mb-3 col-12 col-md-4 err">
            <p><?= $errMsg ?></p>
        </div>
        <div class="w-100"></div>
        <div class="mb-3 col-md-4">
            <label for="formGroupexampleInput" class="form-label">Логин</label>
            <input name="login" value="" type="text" class="form-control" id="formGroupexampleInput">
        </div>
        <div class="w-100"></div>
        <div class="mb-3 col-md-4">
            <label for="exampleInputPassword1" class="form-label">Пароль</label>
            <input name="password1" type="password" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="w-100"></div>
        <div class="mb-3 col-md-4">
            <label for="exampleInputPassword1" class="form-label">Повторить пароль</label>
            <input name="password2" type="password" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="w-100"></div>
        <div class="mb-3 col-md-4">
            <button type="submit" class="btn btn-primary" name="button-reg">Отправить</button>
            <a href="login.php">Войти</a>
        </div>
    </form>
    <!-- Форма END -->
</div>
