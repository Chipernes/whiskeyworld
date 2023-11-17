<?php
/** @var array $categories */
/** @var array $model */
/** @var array $errors */
?>

<h2>Редагування категорії</h2>
<form action="" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="name" class="form-label">Назва категорії</label>
        <input type="text" class="form-control" id="name" name="name" value="<?= $categories['Name'] ?>">
        <?php if (!empty($errors['Name'])): ?>
            <div id="nameHelp" class="form-text text-danger"><?php echo $errors['Name'] ?></div>
        <?php endif; ?>
    </div>
    <div class="col-3">
        <?php $filePath = 'files/categories/' . $categories['Image']; ?>
        <?php if (is_file($filePath)): ?>
            <img src="/<?= $filePath ?>" class="card-img-top img-thumbnail" alt="">
        <?php else: ?>
            <img src="/static/images/no-image.jpg" class="card-img-top img-thumbnail" alt="">
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="file" class="form-label">Файл з фотографією для категорії (замінити фото)</label>
        <input class="form-control" type="file" id="file" name="file" accept="image/jpeg">
    </div>
    <button class="btn btn-primary" type="submit">Зберегти</button>
</form>
