<?php
/** @var array $model */
/** @var array $errors */
?>

<h2>Додавання категорії</h2>
<form action="" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="name" class="form-label">Назва категорії</label>
        <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp">
        <?php if (!empty($errors['name'])): ?>
            <div id="nameHelp" class="form-text text-danger"><?php echo $errors['name'] ?></div>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="file" class="form-label">Файл з фотографією для категорії</label>
        <input class="form-control" type="file" id="file" name="file" accept="image/jpeg">
    </div>
    <button class="btn btn-primary" type="submit">Додати</button>
</form>
