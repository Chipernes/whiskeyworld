<?php
/** @var array $model */
/** @var array $grapeVarieties */

?>

<h1 class="mt-4 mb-5">Редагування сорту винограду</h1>
<form action="" method="post">
    <div class="mb-3">
        <label for="oldName" class="form-label">Стара назва сорту</label>
        <select class="form-control" id="oldName" name="oldName" aria-describedby="oldNameHelp">
        <option value="0" selected disabled hidden="">Назва сорту</option>
        <?php foreach ($grapeVarieties as $grapeVariety): ?>
            <option <?php if ($model['grapeVarietyId'] == $grapeVariety['GrapeVarietyId']) echo "selected"; ?> value="<?= $grapeVariety['GrapeVarietyId'] ?>"><?= $grapeVariety['Name'] ?></option>
        <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Нова назва сорту</label>
        <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp" value="<?= $model['name'] ?>">
        <?php if (!empty($errors['name'])): ?>
            <div id="nameHelp" class="form-text text-danger"><?php echo $errors['name'] ?></div>
        <?php endif; ?>
    </div>
    <a id="edit" href="/grapeVarieties/edit/" class="btn btn-primary">Редагувати</a>
</form>

<script defer>
    const editButton = document.querySelector('#edit');
    editButton.addEventListener('click', () => {
        const option = document.querySelector('#oldName');
        const nameInput = document.querySelector('#name');
        editButton.href = `/grapeVarieties/edit/?grapeVarietyId=${option.value}&name=${nameInput.value}&check=true`;
    });
</script>
