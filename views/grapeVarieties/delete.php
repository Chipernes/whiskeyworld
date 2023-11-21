<?php
/** @var array $grapeVarieties */
?>

<div class="alert alert-danger" role="alert">
    <h4 class="alert-heading">Видалення сорт винограду</h4>
    <div class="mb-3">
        <label for="name" class="form-label">Виберіть назву сорту, яку ви хочете видалити</label>
        <select class="form-control" id="name" name="name" aria-describedby="nameHelp">
            <option value="0" selected disabled hidden="">Назва сорту</option>
            <?php foreach ($grapeVarieties as $grapeVariety): ?>
                <option value="<?= $grapeVariety['GrapeVarietyId'] ?>"><?= $grapeVariety['Name'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <p>Після видалення сорту, всім товари з цим сортом, буде встановлений сорт <b>"Не визначено"</b></p>
    <hr>
    <p class="mb-0">
        <a id="delete" href="/grapeVarieties/delete/yes" class="btn btn-danger">Видалити</a>
        <a href="/grapeVarieties" class="btn btn-light">Відмінити</a>
    </p>
</div>

<script defer>
    const select = document.querySelector('select');
    const deleteButton = document.querySelector('#delete');
    select.addEventListener('input', () => {
        deleteButton.href = `/grapeVarieties/delete/${select.value}/yes`;
    });
</script>
