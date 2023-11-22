<?php

/** @var array $joinedProductWithCategory*/

use models\User;

?>

<h1 class="mt-3 mb-4 fs-1">Список усіх алкогольних напоїв</h1>
<?php if (User::isAdmin()): ?>
    <a href="/products/add" class="btn btn-success mt-3 mb-4">Додати товар</a>
<?php endif; ?>

<div class="row row-cols-1 row-cols-md-4 g-3">
    <?php foreach ($joinedProductWithCategory as $item): ?>

        <div class="col">
            <div class="card h-100 p-3" style="justify-content: space-between">
                <a href="/products/view/<?= $item['ProductId'] ?>" style="text-decoration: none; color: black">
                    <?php $filePath = 'files/products/' . $item['Image']; ?>
                    <?php if (is_file($filePath)): ?>
                        <img style="object-fit: contain; height: 300px" src="/<?= $filePath ?>" class="card-img-top" alt="">
                    <?php else: ?>
                        <img style="object-fit: contain; height: 300px" src="/static/images/no-image.jpg" class="card-img-top" alt="">
                    <?php endif; ?>

                    <div class="card-body">
                        <h5 class="card-title">
                            <?= $item['CategoryName'] ?>
                            <?= $item['Name'] ?>
                            <?= $item['Volume'] . ' л' ?>
                            <?= $item['Strength'] . '%' ?>
                        </h5>
                    </div>
                    <?php if (User::isAdmin()) : ?>
                        <div class="text-center">
                            <a href="/products/edit/<?= $item['ProductId'] ?>"
                               class="btn btn-primary">Редагувати</a>
                            <a href="/products/delete/<?= $item['ProductId'] ?>"
                               class="btn btn-danger">Видалити</a>
                        </div>
                    <?php endif; ?>
                </a>
            </div>
        </div>
    <?php endforeach; ?>
</div>