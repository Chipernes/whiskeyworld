<?php
/** @var array $categories */
?>

<div class="alert alert-danger" role="alert">
    <h4 class="alert-heading">Видалити категорію "<?= $categories['Name'] ?>"?</h4>
    <p>Після видалення категорії, всім товари буде встановлена категорія <b>"Не визначено"</b></p>
    <hr>
    <p class="mb-0">
        <a href="/categories/delete/<?= $categories['CategoryId'] ?>/yes" class="btn btn-danger">Видалити</a>
        <a href="/categories" class="btn btn-light">Відмінити</a>
    </p>
</div>
