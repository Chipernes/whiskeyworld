<?php

/* @var array $orderItems **/
/* @var array $joinedOrdersWithUsers **/
/* @var array $totalPrice **/
/* @var array $statuses **/
/* @var array $orders **/
/* @var array $products **/

$index = 0;

?>

<h1 class="mt-4 mb-5">Детальна інформація про замовлення <?= $orderItems[0]['OrderId'] ?></h1>

<div class="mt-4">
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>№</th>
            <th>Назва продукту</th>
            <th>Кількість</th>
            <th>Ціна</th>
            <th>Вартість</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($orderItems as $orderItem): ?>
            <tr>
                <td><?= $index + 1 ?></td>
                <td><?= $products[$orderItem['ProductId'] - 1]['Name'] ?></td>
                <td><?= $orderItem['Count'] ?></td>
                <td><?= $orderItem['Price'] ?> грн</td>
                <td><?= $orderItem['Price'] * $orderItem['Count'] ?> грн</td>
            </tr>

            <?php $index += 1; ?>
        <?php endforeach; ?>
        <tr>
            <td>Загальна вартість</td>
            <td><?= $totalPrice[$orderItems[0]['OrderId'] - 1]['TotalPrice'] ?> грн</td>
        </tr>
        <tr>
            <td>
                <label for="status" class="form-label">Змінити статус</label>
            </td>
            <td class="d-flex gap-3">
                <select class="form-control" id="status" name="StatusId" aria-describedby="statusHelp">
                    <?php foreach ($statuses as $status): ?>
                        <option <?php if ($status['StatusId'] == $orders[$orderItems[0]['OrderId'] - 1]['StatusId']) echo 'selected'; ?> value="<?= $status['StatusId'] ?>"><?= $status['Name'] ?></option>
                    <?php endforeach; ?>
                </select>
                <a  href="#" id="changeStatus" class="w-50 btn btn-primary">Зберегти сатус</a>
            </td>
        </tr>
        </tbody>
    </table>
</div>

<script defer>
    const button =  document.getElementById("changeStatus");
    let productsData = '<?= $orders[$orderItems[0]['OrderId'] - 1]['StatusId'] ?>';

    let tbody = document.querySelector(".table tbody");
    tbody.addEventListener('input', (event) => {
        let target = event.target;
        productsData = target.value;
    });

    button.addEventListener('click', () => {
        const queryParams = `newStatus=${productsData}`;

        button.href = `/orders/edit?${queryParams}&orderId=<?= $orderItems[0]['OrderId'] ?>`;
    });
</script>
