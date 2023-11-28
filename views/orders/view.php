<?php

/* @var array $orderItems **/

?>

<h1 class="mt-4 mb-5">Детальна інформація про замовлення <?= $orderItems[0]['OrderItemId'] ?></h1>

<div class="mt-4">
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>№</th>
            <th>№ Замовлення</th>
            <th>№ Продукту</th>
            <th>Кількість</th>
            <th>Цінае</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($orderItems as $orderItem): ?>
            <tr>
                <td><?= $orderItem['OrderItemId'] ?></td>
                <td><?= $orderItem['OrderId'] ?></td>
                <td><?= $orderItem['ProductId'] ?></td>
                <td><?= $orderItem['Count'] ?></td>
                <td><?= $orderItem['Price'] ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
