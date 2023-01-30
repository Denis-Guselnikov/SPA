<?php
include "function.php";
include "path.php";
include "controller/posts.php";

if(!$_SESSION['id']) {
    header('location: ' . 'login.php');
}

$operations = selectAll('operation');
$income = getSumIncome();
$expense = getSumExpense();
$result = array_map('getResult', $income, $expense);
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
        <h3>Форма создания записи</h3>
        <div class="mb-3 col-12 col-md-4 err">
            <p><?= $errMsg ?></p>
        </div>
        <form action="" class="form-inline" method="post">
            <div class="mb-3 col-md-6">
                <input type="number" class="form-control" name="sum" placeholder="Сумма">
                <select class="form-control" name="status">
                    <option value="income">Приход</option>
                    <option value="expense">Расход</option>
                </select>
                <input type="text" class="form-control" placeholder="Комментарий" name="description">
                <button type="submit" class="btn btn-primary" name="add_post">Добавить</button>
            </div>
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
                <th scope="col">Действие</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($operations as $operation): ?>
                <tr id="<?= $operation['id']; ?>">
                    <td><?= $operation['id']; ?></td>
                    <td><?= $operation['amount']; ?></td>
                    <td><?= $operation['status']; ?></td>
                    <td><?= $operation['description'] ?></td>
                    <td>
                        <a href="controller/posts.php?delete_id=<?= $operation['id']; ?>" class="btn btn-danger">Удалить</a>
                        <button type="submit" name="button" onclick="deletePost(<?= $operation['id']; ?>);">Удалить Ajax</button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <!-- Таблица END -->

        <div>
            <h3>Итого: <?=$result[0]; ?></h3>
            <h5>Сумма Прихода: <?=$income['SUM(amount)']; ?></h5>
            <h5>Сумма Расхода: <?=$expense['SUM(amount)']; ?></h5>
        </div>
    </div>
</div>

<script>
    function deletePost(id) {
        $(document).ready(function() {
            $.ajax({
                url: 'posts.php',
                type: 'POST',
                data: {id: id},
                success:function () {
                    alert("Удаление произошло!");
                    document.getElementById(id).style.display = "none";
                }
            });
        });
    }
</script>

</body>
</html>
