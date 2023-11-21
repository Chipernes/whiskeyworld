<?php
/** @var array $errors */
/** @var array $grapeVarieties */
?>

<h1 class="mt-4 mb-5">Додавання/редагування/видалення сортів винограду</h1>
<div class="d-flex gap-3">
    <a href="/grapeVarieties/add" class="btn btn-success">Додати сорт</a>
    <a href="/grapeVarieties/edit?check=false" class="btn btn-primary">Редагувати сорт</a>
    <a href="/grapeVarieties/delete" class="btn btn-danger">Видалити сорт</a>
</div>

<div class="mt-4">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>№</th>
                <th>Назва сорт</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($grapeVarieties as $grapeVariety): ?>
                <tr>
                    <td><?= $grapeVariety['GrapeVarietyId'] ?></td>
                    <td><?= $grapeVariety['Name'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

