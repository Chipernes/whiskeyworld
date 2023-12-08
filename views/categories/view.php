<?php
/** @var array $category */
/** @var array $products */

use models\User;
?>

<h1 class="my-4"><?= $category['Name'] ?></h1>
<?php if (User::isAdmin()): ?>
    <a href="/products/add/<?= $category['CategoryId'] ?>" class="btn btn-success mt-3 mb-4">Додати товар</a>
<?php endif; ?>

<div class="row row-cols-1 row-cols-md-4" style="height: 100%">
    <?php foreach ($products as $product): ?>
        <?php if ($product['Visibility'] == 0 && !User::isAdmin()): ?>
            <div class="col mb-3" style="display: none">
        <?php else: ?>
            <div class="col mb-3">
        <?php endif; ?>

            <div class="card h-100 pt-3 pb-2" style="justify-content: space-between">
                <a href="/products/view/<?= $product['ProductId'] ?>" style="text-decoration: none; color: black">
                    <?php if ($product['Visibility'] == 0 && User::isAdmin()): ?>
                    <div class="col mb-3" style="opacity: 0.5">
                    <?php endif; ?>

                    <?php $filePath = 'files/products/' . $product['Image']; ?>
                    <?php if (is_file($filePath)): ?>
                        <img style="object-fit: contain; height: 300px" src="/<?= $filePath ?>" class="card-img-top" alt="">
                    <?php else: ?>
                        <img style="object-fit: contain; height: 300px" src="/static/images/no-image.jpg" class="card-img-top" alt="">
                    <?php endif; ?>

                    <div class="card-body pt-3 px-2 pb-0">
                        <h5 class="card-title fs-6 fw-0" style="font-weight: 400">
                            <?= $category['Name'] ?>
                            <?= $product['Name'] ?>
                            <?= $product['Volume'] . ' л' ?>
                            <?= $product['Strength'] . '%' ?>
                        </h5>
                    </div>

                    <div class="text-danger fs-3 px-2" style="font-weight: 400;">
                        <?= $product['Price']?> <span class="fs-5">₴</span>
                    </div>

                <?php if ($product['Visibility'] == 0 && User::isAdmin()): ?>
                    </div>
                <?php endif; ?>

                    <?php if (User::isAdmin()) : ?>
                        <div class="text-center">
                            <a href="/products/edit/<?= $product['ProductId'] ?>"
                               class="btn btn-primary">Редагувати</a>
                            <a href="/products/delete/<?= $product['ProductId'] ?>"
                               class="btn btn-danger">Видалити</a>
                        </div>
                    <?php endif; ?>
                </a>
            </div>
        </div>
    <?php endforeach; ?>
</div>
