<?php

/* @var array $orders **/

?>

<h1 class="mt-4 mb-5">Список всіх замовлень</h1>
<!--<div class="d-flex gap-3">
    <a href="/sugarContents/add" class="btn btn-success">Додати класифікацію</a>
    <a href="/sugarContents/edit?check=false" class="btn btn-primary">Редагувати класифікацію</a>
    <a href="/sugarContents/delete" class="btn btn-danger">Видалити класифікацію</a>
</div>-->

<div class="mt-4">
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>№</th>
            <th>№ користувача</th>
            <th>Дата</th>
            <th>Повна вартість замовлення</th>
            <th>Переглянути детальніше</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($orders as $order): ?>
            <tr>
                <td><?= $order['OrderId'] ?></td>
                <td><?= $order['UserId'] ?></td>
                <td><?= $order['Date'] ?></td>
                <td><?= $order['TotalPrice'] ?></td>
                <td><a class="btn btn-primary" href="/orders/view/<?= $order['OrderId'] ?>">Детальніше</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
