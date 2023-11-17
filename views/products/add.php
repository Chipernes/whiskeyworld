<?php
/** @var array $model */
/** @var array $errors */
/** @var array $categories */
/** @var array|null $categoryId */
?>

<h2>Додавання товару</h2>
<form action="" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="category" class="form-label">Виберіть категорію алкоголю</label>
        <select class="form-control" id="category" name="CategoryId" aria-describedby="nameHelp">
            <?php foreach ($categories as $category): ?>
                <option <?php if ($category['CategoryId'] == $categoryId) echo 'selected'; ?> value="<?= $category['CategoryId'] ?>"><?= $category['Name'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Назва алкоголю</label>
        <input type="text" class="form-control" id="name" name="Name" aria-describedby="nameHelp">
        <?php if (!empty($errors['Name'])): ?>
            <div id="nameHelp" class="form-text text-danger"><?php echo $errors['Name'] ?></div>
        <?php endif; ?>
    </div>

    <div class="mb-3">
        <label for="type" class="form-label">Тип алкоголю (опціонально)</label>
        <input type="text" class="form-control" id="type" name="Type" aria-describedby="typeHelp">
        <?php if (!empty($errors['Type'])): ?>
            <div id="typeHelp" class="form-text text-danger"><?php echo $errors['Type'] ?></div>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="color" class="form-label">Колір алкоголю</label>
        <input type="text" class="form-control" id="color" name="Color" aria-describedby="colorHelp">
        <?php if (!empty($errors['Color'])): ?>
            <div id="colorHelp" class="form-text text-danger"><?php echo $errors['Color'] ?></div>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="volume" class="form-label">Об'єм алкоголю</label>
        <input type="number" class="form-control" id="volume" name="Volume" aria-describedby="volumeHelp">
        <?php if (!empty($errors['Volume'])): ?>
            <div id="volumeHelp" class="form-text text-danger"><?php echo $errors['Volume'] ?></div>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="strength" class="form-label">Міцність алкоголю</label>
        <input type="number" class="form-control" id="strength" name="Strength" aria-describedby="strengthHelp">
        <?php if (!empty($errors['Strength'])): ?>
            <div id="strengthHelp" class="form-text text-danger"><?php echo $errors['Strength'] ?></div>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="brand" class="form-label">Бренд алкоголю</label>
        <input type="text" class="form-control" id="brand" name="BrandId">
        <!--<select class="form-control" id="CountryId" name="CountryId">
            <?php /*foreach ($categories as $categories): */?>
                <option value="<?php /*= $categories['AlcoholId'] */?>"><?php /*= $categories['Name'] */?></option>
            <?php /*endforeach; */?>
        </select>-->
    </div>
    <div class="mb-3">
        <label for="taste" class="form-label">Смак алкоголю</label>
        <input type="text" class="form-control" id="taste" name="Taste" aria-describedby="tasteHelp">
        <?php if (!empty($errors['Taste'])): ?>
            <div id="tasteHelp" class="form-text text-danger"><?php echo $errors['Taste'] ?></div>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="aging" class="form-label">Витримка алкоголю (опціонально)</label>
        <input type="number" class="form-control" id="aging" name="Aging" aria-describedby="agingHelp">
        <?php if (!empty($errors['Aging'])): ?>
            <div id="agingHelp" class="form-text text-danger"><?php echo $errors['Aging'] ?></div>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="grapeVariety" class="form-label">Сорт винограду алкоголю (опціонально)</label>
        <input type="text" class="form-control" id="grapeVariety" name="GrapeVarietyId">
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Ціна алкоголю</label>
        <input type="number" class="form-control" id="price" name="Price" aria-describedby="priceHelp">
        <?php if (!empty($errors['Price'])): ?>
            <div id="priceHelp" class="form-text text-danger"><?php echo $errors['Price'] ?></div>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="count" class="form-label">Кількість алкоголю</label>
        <input type="number" class="form-control" id="count" name="Count" aria-describedby="countHelp">
        <?php if (!empty($errors['Count'])): ?>
            <div id="countHelp" class="form-text text-danger"><?php echo $errors['Count'] ?></div>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Опис алкоголю</label>
        <textarea class="form-control ckeditor" name="Description" id="description"></textarea>
    </div>
    <div class="mb-3">
        <label for="file" class="form-label">Файл з фотографією для товару</label>
        <input multiple class="form-control" type="file" id="file" name="file" accept="image/jpeg">
    </div>
    <div class="mb-3">
        <label for="visibility" class="form-label">Видимість для клієнтів</label>
        <select class="form-control" id="vsibility" name="Visibility">
                <option value="1">Так</option>
                <option value="0">Ні</option>
        </select>
    </div>
    <button class="btn btn-primary" type="submit">Додати</button>
</form>
<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '.ckeditor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>

