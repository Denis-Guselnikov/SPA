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

        <!-- Форма Ajax START -->
        <h3>Форма создания записи</h3>
        <div class="mb-3 col-md-6">
            <input type="number" class="form-control" name="sum" id="summa" placeholder="Сумма">
            <select class="form-control" name="status" id="status">
                <option value="income">Приход</option>
                <option value="expense">Расход</option>
            </select>
            <input type="text" id="description" class="form-control" placeholder="Комментарий" name="description">
            <button type="submit" class="btn btn-primary" name="add_post" id="add">Добавить</button>
        </div>
        <!-- Форма Ajax END-->

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
                        <button type="submit" name="button" onclick="deletePost(<?= $operation['id']; ?>);">Удалить Ajax</button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <!-- Таблица END -->

        <!-- Данные -->
        <div id="total">
            <h3>Итого: <?=$result[0]; ?></h3>
            <h5>Сумма Прихода: <?=$income['SUM(amount)']; ?></h5>
            <h5>Сумма Расхода: <?=$expense['SUM(amount)']; ?></h5>
        </div>

        <!-- Данные после обнавления -->
        <div id="total2"></div>
    </div>
</div>

<script>
    function deletePost(id) {
        $(document).ready(function() {
            $.ajax({
                url: 'posts.php',
                type: 'GET',
                data: {id: id},
                success:function (data) {
                    document.getElementById(id).style.display = "none";

                    let result = JSON.parse(data);

                    // Выводим данные сумм в #total2
                    const totalSum = '<div>'
                        +'<h3>'+ 'Итого: ' + result[2][0] +'</h3>'
                        +'<h5>'+ 'Сумма Прихода: ' + result[0]["SUM(amount)"]  +'</h5>'
                        +'<h5>'+ 'Сумма Расхода: ' + result[1]["SUM(amount)"]  +'</h5>'
                        +'</div>'
                    $('#total2').html(totalSum);

                    // Скрыть текущие данные #total
                    document.getElementById("total").style.display = "none";
                }
            });
        });
    }

    $(document).ready(function () {
        $("#add").on('click', function () {

            let amount = document.getElementById("summa").value;
            let status = document.getElementById("status").value;
            let description = document.getElementById("description").value;

            $.ajax({
                method: "POST",
                url: "posts.php",
                dataType: 'text',
                data: {status: status, amount: amount, description: description},
                success: function(data) {
                    if(data == 1) {
                        alert('Заполните все поля!');
                    }
                    let result = JSON.parse(data);

                    // Добавление новой строки с данными в таблицу
                    const tableRow = '<tr id="'+ result[0]["id"] +'">'
                        +'<td>'+ result[0]["id"] +'</td>'
                        +'<td>'+ result[0]["params"]["amount"]+ '.00' +'</td>'
                        +'<td>'+ result[0]["params"]["status"] +'</td>'
                        +'<td>'+ result[0]["params"]["description"] +'</td>'
                        +'<td><button type="submit" onclick="deletePost('+ result[0]["id"] +')">Удалить Ajax</button></td>'
                        +'</tr>'
                    $('.table tbody').prepend(tableRow);

                    // Выводим данные сумм в #total2
                    const totalSum = '<div>'
                    +'<h3>'+ 'Итого: ' + result[3][0] +'</h3>'
                    +'<h5>'+ 'Сумма Прихода: ' + result[1]["SUM(amount)"]  +'</h5>'
                    +'<h5>'+ 'Сумма Расхода: ' + result[2]["SUM(amount)"]  +'</h5>'
                    +'</div>'
                    $('#total2').html(totalSum);

                    // Скрыть текущие данные #total
                    document.getElementById("total").style.display = "none";

                    // Обнуление Суммы и Комментарий
                    $('#summa').val('');
                    $('#description').val('');
                },
            });
        });
    });
</script>

</body>
</html>
