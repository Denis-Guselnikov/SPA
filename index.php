<?php


?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <?php include "include/head.php"; ?>
    <title>SPA-project</title>
</head>
<body>
    <?php include "include/header.php"; ?>


    <div class="container">
        <div class="row content">

            <!-- Форма START -->
            <h2>Форма создания записи</h2>
            <form action="" class="form-inline">
                <input type="hidden" name="url" value="">
                <input type="number" class="form-control" name="sum" placeholder="Сумма">
                <select class="form-control" name="status">
                    <option value="income">Приход</option>
                    <option value="expense">Расход</option>
                </select>
                <input type="text" class="form-control" placeholder="Комментарий" name="description">
                <button type="submit" class="btn btn-primary">Добавить</button>
            </form>
            <!-- Форма END -->

            <!-- Таблица START -->
            <h2>Последние 10 записей</h2>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Сумма</th>
                    <th scope="col">Тип</th>
                    <th scope="col">Комментарий</th>
                    <th scope="col">Удалить</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>ID</td>
                        <td>Сумма</td>
                        <td>Тип</td>
                        <td>Комментарий</td>
                        <td>Удалить</td>
                    </tr>
                </tbody>
            </table>
            <!-- Таблица END -->

            <div class="sum">
                <h3>Итого:</h3>
                <h5>Сумма Прихода:</h5>
                <h5>Сумма Расхода:</h5>
            </div>
        </div>
    </div>

</body>
</html>