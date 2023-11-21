<?php
/** @var array $errors */
/** @var array $sugarContents */
?>

<h1 class="mt-4 mb-5">Додавання/редагування/видалення класифікації за вмістом цукром</h1>
<div class="d-flex gap-3">
    <a href="/sugarContents/add" class="btn btn-success">Додати класифікацію</a>
    <a href="/sugarContents/edit?check=false" class="btn btn-primary">Редагувати класифікацію</a>
    <a href="/sugarContents/delete" class="btn btn-danger">Видалити класифікацію</a>
</div>

<div class="mt-4">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>№</th>
                <th>Назва класифікації</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sugarContents as $sugarContent): ?>
                <tr>
                    <td><?= $sugarContent['SugarContentId'] ?></td>
                    <td><?= $sugarContent['Name'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

