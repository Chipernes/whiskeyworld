<?php
/** @var array $errors */
/** @var array $brands */
?>

<h1 class="mt-4 mb-5">Додавання/редагування/видалення брендів</h1>
<div class="d-flex gap-3">
    <a href="/brands/add" class="btn btn-success">Додати бренд</a>
    <a href="/brands/edit?check=false" class="btn btn-primary">Редагувати бренд</a>
    <a href="/brands/delete" class="btn btn-danger">Видалити бренд</a>
</div>

<div class="mt-4">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>№</th>
                <th>Назва бренду</th>
                <th>Країна реєстрації бренда</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($brands as $brand): ?>
                <tr>
                    <td><?= $brand['BrandId'] ?></td>
                    <td><?= $brand['Name'] ?></td>
                    <td><?= $brand['Country'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

