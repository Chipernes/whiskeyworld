<?php
/** @var array $model */
/** @var array $errors */
/** @var array $categories */
/** @var array|null $categoryId */
/** @var array|null $grapeVarieties */
/** @var array|null $brands */
/** @var array|null $product */
/** @var array|null $sugarContents */
?>

<h2 class="mt-3 mb-4 fs-1">Редагування товару</h2>
<form action="" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="category" class="form-label">Виберіть категорію алкоголю <span class="text-danger">*</span></label>
        <select class="form-control" id="category" name="CategoryId" aria-describedby="nameHelp">
            <?php foreach ($categories as $category): ?>
                <option <?php if ($category['CategoryId'] == $categoryId) echo 'selected'; ?> value="<?= $category['CategoryId'] ?>"><?= $category['Name'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Назва алкоголю <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" name="Name" aria-describedby="nameHelp" value="<?= $product['Name'] ?>">
        <?php if (!empty($errors['Name'])): ?>
            <div id="nameHelp" class="form-text text-danger"><?php echo $errors['Name'] ?></div>
        <?php endif; ?>
    </div>

    <div class="mb-3">
        <label for="type" class="form-label">Тип алкоголю (опціонально)</label>
        <input type="text" class="form-control" id="type" name="Type" aria-describedby="typeHelp" value="<?= $product['Type'] ?>">
        <?php if (!empty($errors['Type'])): ?>
            <div id="typeHelp" class="form-text text-danger"><?php echo $errors['Type'] ?></div>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="color" class="form-label">Колір алкоголю <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="color" name="Color" aria-describedby="colorHelp" value="<?= $product['Color'] ?>">
        <?php if (!empty($errors['Color'])): ?>
            <div id="colorHelp" class="form-text text-danger"><?php echo $errors['Color'] ?></div>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="sugarContent" class="form-label">Виберіть класифікація за вмістом цукру</label>
        <select class="form-control" id="category" name="SugarContentId" aria-describedby="sugarContentHelp">
            <option value="" disabled selected hidden>Виберіть класифікацію за вмістом цукру</option>
            <?php foreach ($sugarContents as $sugarContent): ?>
                <option value="<?= $sugarContent['SugarContentId'] ?>"><?= $sugarContent['Name'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="volume" class="form-label">Об'єм алкоголю <span class="text-danger">*</span></label>
        <input type="number" class="form-control" id="volume" name="Volume" aria-describedby="volumeHelp" value="<?= $product['Volume'] ?>">
        <?php if (!empty($errors['Volume'])): ?>
            <div id="volumeHelp" class="form-text text-danger"><?php echo $errors['Volume'] ?></div>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="strength" class="form-label">Міцність алкоголю <span class="text-danger">*</span></label>
        <input type="number" class="form-control" id="strength" name="Strength" aria-describedby="strengthHelp" value="<?= $product['Strength'] ?>">
        <?php if (!empty($errors['Strength'])): ?>
            <div id="strengthHelp" class="form-text text-danger"><?php echo $errors['Strength'] ?></div>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="brand" class="form-label">Бренд алкоголю (опціонально)</label>
        <select class="form-control" id="brand" name="BrandId">
            <option value="" disabled selected hidden>Виберіть бренд</option>
            <?php foreach ($brands as $brand): ?>
                <option <?php if ($brand['BrandId'] == $product['BrandId']) echo 'selected'; ?> value="<?= $brand['BrandId'] ?>"><?= $brand['Name'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="taste" class="form-label">Смак алкоголю <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="taste" name="Taste" aria-describedby="tasteHelp" value="<?= $product['Taste'] ?>">
        <?php if (!empty($errors['Taste'])): ?>
            <div id="tasteHelp" class="form-text text-danger"><?php echo $errors['Taste'] ?></div>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="aging" class="form-label">Витримка алкоголю (опціонально)</label>
        <input type="number" class="form-control" id="aging" name="Aging" aria-describedby="agingHelp" value="<?= $product['Aging'] ?>">
        <?php if (!empty($errors['Aging'])): ?>
            <div id="agingHelp" class="form-text text-danger"><?php echo $errors['Aging'] ?></div>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="grapeVariety" class="form-label">Сорт винограду алкоголю (опціонально)</label>
        <select class="form-control" id="grapeVariety" name="GrapeVarietyId">
            <option value="" disabled selected hidden>Виберіть сорт винограду</option>
            <option value="">Не для цього алкоголю</option>
            <?php foreach ($grapeVarieties as $grapeVariety): ?>
                <option <?php if ($grapeVariety['GrapeVarietyId'] == $product['GrapeVarietyId']) echo 'selected'; ?> value="<?= $grapeVariety['GrapeVarietyId'] ?>"><?= $grapeVariety['Name'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Ціна алкоголю <span class="text-danger">*</span></label>
        <input type="number" class="form-control" id="price" name="Price" aria-describedby="priceHelp" value="<?= $product['Price'] ?>">
        <?php if (!empty($errors['Price'])): ?>
            <div id="priceHelp" class="form-text text-danger"><?php echo $errors['Price'] ?></div>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="count" class="form-label">Кількість алкоголю <span class="text-danger">*</span></label>
        <input type="number" class="form-control" id="count" name="Count" aria-describedby="countHelp" value="<?= $product['Count'] ?>">
        <?php if (!empty($errors['Count'])): ?>
            <div id="countHelp" class="form-text text-danger"><?php echo $errors['Count'] ?></div>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Опис алкоголю <span class="text-danger">*</span></label>
        <textarea class="form-control ckeditor" name="Description" id="description"><?= $product['Description'] ?></textarea>
    </div>
    <div class="col-3">
        <label for="file" class="form-label ">Файл з фотографією для товару</label>

        <?php $filePath = 'files/categories/' . $categories['Image']; ?>
        <?php if (is_file($filePath)): ?>
            <img src="/<?= $filePath ?>" class="card-img-top img-thumbnail" alt="">
        <?php else: ?>
            <img src="/static/images/no-image.jpg" class="card-img-top img-thumbnail" alt="">
        <?php endif; ?>
        <input multiple class="form-control mt-3 mb-3" type="file" id="file" name="file" accept="image/jpeg" value="<?= $product['Image'] ?>">
    </div>
    <div class="mb-3">
        <label for="visibility" class="form-label">Видимість для клієнтів <span class="text-danger">*</span></label>
        <select class="form-control" id="visibility" name="Visibility">
            <option value="1">Так</option>
            <option value="0">Ні</option>
        </select>
    </div>
    <button class="btn btn-primary" type="submit">Зберегти</button>
</form>
<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '.ckeditor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>

