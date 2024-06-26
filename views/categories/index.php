<?php
/** @var array $categories */
\core\Core::getInstance()->pageParams['title'] = 'Категорії товарів';

use models\User;

?>

<h1 class="mt-4 mb-5">Список категорій</h1>
<?php if (User::isAdmin()) : ?>
    <a href="/categories/add" class="btn btn-success mt-3 mb-4">Додати категорію</a>
<?php endif; ?>
<div class="row row-cols-1 row-cols-md-4 g-4 categories-list">
    <?php foreach ($categories as $category): ?>
        <div class="col">
            <a href="/categories/view/<?= $category['CategoryId']?>" class="card-link">
                <div class="card">
                    <?php $filePath = 'files/categories/' . $category['Image']; ?>
                    <?php if (is_file($filePath)): ?>
                        <img src="/<?= $filePath ?>" class="card-img-top" alt="">
                    <?php else: ?>
                        <img src="/static/images/no-image.jpg" class="card-img-top" alt="">
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title text-center"><?= $category['Name'] ?></h5>
                    </div>
                    <?php if (User::isAdmin()) : ?>
                        <div class="card-body text-center">
                            <a href="/categories/edit/<?= $category['CategoryId'] ?>" class="btn btn-primary">Редагувати</a>
                            <a href="/categories/delete/<?= $category['CategoryId'] ?>" class="btn btn-danger">Видалити</a>
                        </div>
                    <?php endif; ?>
                </div>
            </a>
        </div>
    <?php endforeach; ?>
</div>
