<?php

/* @var array $orders **/
/* @var array $joinedOrdersWithUsers **/
/* @var array $joinedOrdersWithStatuses **/

$index = 0;

?>

<h1 class="mt-4 mb-5">Список всіх замовлень</h1>

<div class="mt-4">
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>№</th>
            <th>Ім'я та прізвище користувача</th>
            <th>Номер телефону</th>
            <th>Дата</th>
            <th>Повна вартість замовлення</th>
            <th>Статус</th>
            <th>Переглянути детальніше</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($orders as $order): ?>
            <tr>
                <td><?= $order['OrderId'] ?></td>
                <td><?= $joinedOrdersWithUsers[$index]['Firstname'], ' ', $joinedOrdersWithUsers[$index]['Lastname'] ?></td>
                <td><?= $joinedOrdersWithUsers[$index]['PhoneNumber'] ?></td>
                <td><?= $order['Date'] ?></td>
                <td><?= $order['TotalPrice'] ?> грн</td>
                <td><?= $joinedOrdersWithStatuses[$index]['StatusName'] ?></td>
                <td><a class="btn btn-primary" href="/orders/view/<?= $order['OrderId'] ?>">Детальніше</a></td>
            </tr>
        <?php $index += 1; ?>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
