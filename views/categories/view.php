<?php
/** @var array $category */

/** @var array $products */

use models\User;

?>

<h1><?= $category['Name'] ?></h1>
<?php if (User::isAdmin()): ?>
    <a href="/products/add/<?= $category['CategoryId'] ?>" class="btn btn-success mt-3 mb-4">Додати товар</a>
<?php endif; ?>

<div class="row row-cols-1 row-cols-md-4 g-3">
    <?php foreach ($products as $product): ?>

        <div class="col">
            <div class="card h-100 p-3" style="justify-content: space-between">
                <a href="/products/view/<?= $product['ProductId'] ?>" style="text-decoration: none; color: black">
                    <?php $filePath = 'files/products/' . $product['Image']; ?>
                    <?php if (is_file($filePath)): ?>
                        <img style="object-fit: contain; width: width: 200px; height: 300px" src="/<?= $filePath ?>"
                             class="card-img-top" alt="">
                    <?php else: ?>
                        <img style="object-fit: contain; width: width: 200px; height: 300px"
                             src="/static/images/no-image.jpg" class="card-img-top" alt="">
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
                        <div class="text-center">
                            <a href="/products/edit/<?= $category['CategoryId'] ?>"
                               class="btn btn-primary">Редагувати</a>
                            <a href="/products/delete/<?= $category['CategoryId'] ?>"
                               class="btn btn-danger">Видалити</a>
                        </div>
                    <?php endif; ?>
                </a>
            </div>
        </div>
    <?php endforeach; ?>
</div>
