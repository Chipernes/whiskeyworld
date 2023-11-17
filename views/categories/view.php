<?php
/** @var array $category */
/** @var array $products */

use models\User;

?>

<h1><?= $category['Name'] ?></h1>
<?php if (User::isAdmin()): ?>
    <a href="/products/add/<?= $category['CategoryId'] ?>" class="btn btn-success mt-3 mb-4">Додати товар</a>
<?php endif; ?>

<div class="row row-cols-1 row-cols-md-4 g-4 categories-list">
    <?php foreach ($products as $product): ?>
        <div class="col">
            <a href="/products/view/<?= $product['ProductId'] ?>" class="card-link">
                <div class="card">

                    <?php $filePath = 'files/products/' . $product['Image']; ?>
                    <?php if (is_file($filePath)): ?>
                        <img src="/<?= $filePath ?>" class="card-img-top" alt="">
                    <?php else: ?>
                        <img src="/static/images/no-image.jpg" class="card-img-top" alt="">
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title">
                            <?= $category['Name'] ?>
                            <?= $product['Name'] ?>
                            <?= $product['Volume'] . 'л' ?>
                            <?= $product['Strength'] . '%' ?>
                        </h5>
                    </div>

                    <?php if (User::isAdmin()) : ?>
                        <div class="card-body text-center">
                            <a href="/products/edit/<?= $category['CategoryId'] ?>" class="btn btn-primary">Редагувати</a>
                            <a href="/products/delete/<?= $category['CategoryId'] ?>" class="btn btn-danger">Видалити</a>
                        </div>
                    <?php endif; ?>
                </div>
            </a>
        </div>
    <?php endforeach; ?>
</div>
