<?php
/** @var array $sugarContents */
?>

<div class="alert alert-danger" role="alert">
    <h4 class="alert-heading">Видалення класифікації за вмістом цукру</h4>
    <div class="mb-3">
        <label for="name" class="form-label">Виберіть назву класифікації, яку ви хочете видалити</label>
        <select class="form-control" id="name" name="name" aria-describedby="nameHelp">
            <option value="0" selected disabled hidden="">Назва класифікації</option>
            <?php foreach ($sugarContents as $sugarContent): ?>
                <option value="<?= $sugarContent['SugarContentId'] ?>"><?= $sugarContent['Name'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <p>Після видалення класифікації, всім товари з цією класифікацією, буде встановлена класифікація <b>"Не визначено"</b></p>
    <hr>
    <p class="mb-0">
        <a id="delete" href="/sugarContents/delete/yes" class="btn btn-danger">Видалити</a>
        <a href="/sugarContents" class="btn btn-light">Відмінити</a>
    </p>
</div>

<script defer>
    const select = document.querySelector('select');
    const deleteButton = document.querySelector('#delete');
    select.addEventListener('input', () => {
        deleteButton.href = `/sugarContents/delete/${select.value}/yes`;
    });
</script>
