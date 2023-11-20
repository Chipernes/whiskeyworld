<?php
/** @var array $brands */
?>

<div class="alert alert-danger" role="alert">
    <h4 class="alert-heading">Видалення бренда</h4>
    <div class="mb-3">
        <label for="name" class="form-label">Виберіть назву бренда, якого ви хочете видалити</label>
        <select class="form-control" id="name" name="name" aria-describedby="nameHelp">
            <option value="0" selected disabled hidden="">Назва бренда</option>
            <?php foreach ($brands as $brand): ?>
                <option value="<?= $brand['BrandId'] ?>"><?= $brand['Name'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <p>Після видалення бренду, всім товари з цим брендом, буде встановлений бренд <b>"Не визначено"</b></p>
    <hr>
    <p class="mb-0">
        <a id="delete" href="/brands/delete/yes" class="btn btn-danger">Видалити</a>
        <a href="/brands" class="btn btn-light">Відмінити</a>
    </p>
</div>

<script defer>
    const select = document.querySelector('select');
    const deleteButton = document.querySelector('#delete');
    select.addEventListener('input', () => {
        deleteButton.href = `/brands/delete/${select.value}/yes`;
    });
</script>
