<?php
/** @var array $cart */
?>
<h1>Кошик</h1>
<table class="table">
    <thead>
        <th>№</th>
        <th>Назва товару</th>
        <th>Вартість одиниці</th>
        <th>Кількість</th>
        <th>Загальна вартість</th>
    </thead>
    <?php
    $index = 1;
    foreach ($cart['products'] as $row): ?>
    <tr>
        <td><?= $index ?></td>
        <td><?= $row['products']['Name'] ?></td>
        <td><?= $row['products']['Price'] ?></td>
        <td><input class="form-control" type="number" value="<?= $row['count'] ?>"></td>
        <td><?= $row['products']['Price'] * $row['count'] ?></td>
    </tr>

        <?php
        $index += 1;
    endforeach; ?>
    <tfoot>
    <tr>
        <th></th>
        <th>Загальна сума</th>
        <th><?= $cart['totalPrice'] ?> грн</th>
    </tr>
    </tfoot>
</table>

