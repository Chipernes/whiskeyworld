<?php
/** @var array $model */
/** @var array $brands */

?>

<h1 class="mt-4 mb-5">Редагування бренда</h1>
<form action="" method="post">
    <div class="mb-3">
        <label for="oldName" class="form-label">Стара назва бренда</label>
        <select class="form-control" id="oldName" name="oldName" aria-describedby="oldNameHelp">
        <option value="0" selected disabled hidden="">Назва бренда</option>
        <?php foreach ($brands as $brand): ?>
            <option <?php if ($model['brandId'] == $brand['BrandId']) echo "selected"; ?> value="<?= $brand['BrandId'] ?>"><?= $brand['Name'] ?></option>
        <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Нова назва бренда</label>
        <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp" value="<?= $model['name'] ?>">
        <?php if (!empty($errors['name'])): ?>
            <div id="nameHelp" class="form-text text-danger"><?php echo $errors['name'] ?></div>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="country" class="form-label">Країна реєстрації бренда</label>
        <input type="text" class="form-control" id="country" name="country" aria-describedby="countryHelp" value="<?= $model['country'] ?>">
        <?php if (!empty($errors['country'])): ?>
            <div id="countryHelp" class="form-text text-danger"><?php echo $errors['country'] ?></div>
        <?php endif; ?>
    </div>
    <a id="edit" href="/brands/edit/" class="btn btn-primary">Редагувати</a>
</form>

<script defer>
    const editButton = document.querySelector('#edit');
    editButton.addEventListener('click', () => {
        const option = document.querySelector('#oldName');
        const nameInput = document.querySelector('#name');
        const countryInput = document.querySelector('#country');
        editButton.href = `/brands/edit/?brandId=${option.value}&name=${nameInput.value}&country=${countryInput.value}&check=true`;
    });
</script>
