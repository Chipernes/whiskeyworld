<?php
/** @var array $model */
/** @var array $errors */
?>

<h1 class="mt-4 mb-5">Додавання сорту винограду</h1>
<form action="" method="post">
    <div class="mb-3">
        <label for="name" class="form-label">Назва сорту винограду</label>
        <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp">
        <?php if (!empty($errors['name'])): ?>
            <div id="nameHelp" class="form-text text-danger"><?php echo $errors['name'] ?></div>
        <?php endif; ?>
    </div>
    <button class="btn btn-primary" type="submit">Додати</button>
</form>