<?php
/** @var array $categories */
?>

<h1 class="mt-4 mb-5">Алкогольні напої</h1>
<div class="row justify-content-between">
    <div class="col-6">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <?php for ($i = 2; $i <= 10; $i += 1): ?>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?= $i ?>" aria-label="Slide <?= $i + 1 ?>"></button>
                <?php endfor; ?>
            </div>
            <div class="carousel-inner rounded">
                <div class="carousel-item active">
                    <img src="/static/images/slider/1.jpg" class="d-block w-100" alt="1">
                </div>
                <?php for ($i = 2; $i <= 10; $i += 1): ?>
                    <div class="carousel-item">
                        <img src="/static/images/slider/<?= $i ?>.jpg" class="d-block w-100" alt="<?= $i ?>">
                    </div>
                <?php endfor; ?>
            </div>
            <button class="carousel-control-prev opacity-80" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bg-dark rounded-circle" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next opacity-80" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon bg-dark rounded-circle" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <div class="col-6">
        <div style="padding-left: 20px">
            <h5>Популярні категорії</h5>
            <div class="list-group d-flex justify-content-between flex-row gap-5">
                <div style="width: 100%">
                    <a href="/categories/view/1" class="list-group-item border-0 border-bottom p-0 py-2 d-flex align-items-center gap-3 text-primary"><img src="/static/images/popular/1.png" alt=""><p class="m-0">Віски</p></a>
                    <a href="/categories/view/10" class="list-group-item border-0 border-bottom p-0 py-2 d-flex align-items-center gap-3 text-primary"><img src="/static/images/popular/2.png" alt=""><p class="m-0">Коньяк та бренді</p></a>
                    <a href="/categories/view/2" class="list-group-item border-0 border-bottom p-0 py-2 d-flex align-items-center gap-3 text-primary"><img src="/static/images/popular/3.png" alt=""><p class="m-0">Тихе вино</p></a>
                    <a href="/categories/view/7" class="list-group-item border-0 border-bottom p-0 py-2 d-flex align-items-center gap-3 text-primary"><img src="/static/images/popular/4.png" alt=""><p class="m-0">Горілка</p></a>
                </div>
                <div style="width: 100%">
                    <a href="/categories/view/3" class="list-group-item border-0 border-bottom p-0 py-2 d-flex align-items-center gap-3 text-primary"><img src="/static/images/popular/5.png" alt=""><p class="m-0">Шампанське та ігристе вино</p></a>
                    <a href="/categories/view/12" class="list-group-item border-0 border-bottom p-0 py-2 d-flex align-items-center gap-3 text-primary"><img src="/static/images/popular/6.png" alt=""><p class="m-0">Пиво</p></a>
                    <a href="/categories/view/5" class="list-group-item border-0 border-bottom p-0 py-2 d-flex align-items-center gap-3 text-primary"><img src="/static/images/popular/7.png" alt=""><p class="m-0">Ром</p></a>
                    <a href="/categories/view/6" class="list-group-item border-0 border-bottom p-0 py-2 d-flex align-items-center gap-3 text-primary"><img src="/static/images/popular/8.png" alt=""><p class="m-0">Лікери та аперитиви</p></a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row row-cols-1 row-cols-md-4 g-4 categories-list mt-4">
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
                </div>
            </a>
        </div>
    <?php endforeach; ?>
</div>
