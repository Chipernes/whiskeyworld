<?php
/** @var array $model */
/** @var array $sugarContents */

?>

<h1 class="mt-4 mb-5">Редагування класифікації за вмістом цукру</h1>
<form action="" method="post">
    <div class="mb-3">
        <label for="oldName" class="form-label">Стара назва класифікації</label>
        <select class="form-control" id="oldName" name="oldName" aria-describedby="oldNameHelp">
        <option value="0" selected disabled hidden="">Назва класифікації</option>
        <?php foreach ($sugarContents as $sugarContent): ?>
            <option <?php if ($model['sugarContentId'] == $sugarContent['SugarContentId']) echo "selected"; ?> value="<?= $sugarContent['SugarContentId'] ?>"><?= $sugarContent['Name'] ?></option>
        <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Нова назва класифікації</label>
        <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp" value="<?= $model['name'] ?>">
        <?php if (!empty($errors['name'])): ?>
            <div id="nameHelp" class="form-text text-danger"><?php echo $errors['name'] ?></div>
        <?php endif; ?>
    </div>
    <a id="edit" href="/sugarContents/edit/" class="btn btn-primary">Редагувати</a>
</form>

<script defer>
    const editButton = document.querySelector('#edit');
    editButton.addEventListener('click', () => {
        const option = document.querySelector('#oldName');
        const nameInput = document.querySelector('#name');
        editButton.href = `/sugarContents/edit/?sugarContentId=${option.value}&name=${nameInput.value}&check=true`;
    });
</script>
