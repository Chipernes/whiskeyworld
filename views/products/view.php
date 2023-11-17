<?php
/** @var array $product */
?>

<h1><?= $product['Name'] ?></h1>
<div class="container">
    <div class="row">
        <div class="col-6">
            <?php $filePath = 'files/products/' . $product['Image'] . '.jpg'; ?>
            <?php if (is_file($filePath)): ?>
                <img src="/<?= $filePath ?>" class="card-img-top img-thumbnail" alt="">
            <?php else: ?>
                <img src="/static/images/no-image.jpg" class="card-img-top img-thumbnail" alt="">
            <?php endif; ?>
        </div>
        <div class="col-6">
            <div class="mb-3">
                Ціна товару: <strong><?= $product['Price'] ?> грн</strong>
            </div>
            <div class="mb-3">
                Доступна кількість: <strong><?= $product['Count'] ?></strong>
            </div>
            <div class="mb-3">
                <label class="form-label" for="count">Кількість:</label>
                <input min="1" max="<?= $product['Count'] ?>" value="1" class="form-control" type="number" name="count" id="count">
            </div>
            <div class="mb-3">
                <button class="btn btn-primary">Придбати</button>
            </div>
        </div>
    </div>
</div>

