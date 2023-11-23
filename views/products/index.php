<?php

/** @var array $brands*/
/** @var array $products*/
/** @var array $groupedProductsByTypes*/
/** @var array $groupedProductsByValues*/
/** @var array $joinedProductWithCategory*/

use models\User;

?>

<?php include('themes/light/svg.html') ?>

<h1 class="mt-3 mb-4 fs-1">Список усіх алкогольних напоїв</h1>
<?php if (User::isAdmin()): ?>
    <a href="/products/add" class="btn btn-success mt-3 mb-4">Додати товар</a>
<?php endif; ?>

<div class="row">
    <aside class="col-2">
        <div class="mb-3">
            <h5>Бренд</h5>
            <div>
                <ul class="p-0" style="list-style: none">
                    <?php foreach ($brands as $brand) : ?>
                        <li>
                            <a href="javascript:void(0);" onclick="toggleBrand('<?= $brand['Name'] ?>')" class="btn p-0 d-flex align-items-center gap-2">
                                <svg width="16" height="16">
                                    <use xlink:href="#unchecked"></use>
                                </svg>
                                <?= $brand['Name'] ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

        </div>
        <div class="mb-3">
            <h5>Ціна</h5>
            <div>
                Тут буде рендж інпут
                <input type="range" name="" id="">
            </div>
        </div>
        <div class="mb-3">
            <h5>Вид</h5>
            <div>
                <ul class="p-0" style="list-style: none">
                    <?php foreach ($groupedProductsByTypes as $groupedProductsByType) : ?>
                        <li>
                            <a href="" class="btn p-0 d-flex align-items-center gap-2">
                                <svg width="16" height="16">
                                    <use xlink:href="#unchecked"></use>
                                </svg>
                                <?= $groupedProductsByType['Type'] ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <div class="mb-3">
            <h5>Об'єм</h5>
            <div>
                <ul class="p-0" style="list-style: none">
                    <?php foreach ($groupedProductsByValues as $groupedProductsByValue) : ?>
                        <li>
                            <a href="" class="btn p-0 d-flex align-items-center gap-2">
                                <svg width="16" height="16">
                                    <use xlink:href="#unchecked"></use>
                                </svg>
                                <?= $groupedProductsByValue['Volume'] ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <div class="mb-3">
            <h5>Витримка</h5>
            <div>
                <ul class="p-0" style="list-style: none">
                    <li>
                        <a href="" class="btn p-0 d-flex align-items-center gap-2">
                            <svg width="16" height="16">
                                <use xlink:href="#unchecked"></use>
                            </svg>
                            до 5 років
                        </a>
                    </li>
                    <li>
                        <a href="" class="btn p-0 d-flex align-items-center gap-2">
                            <svg width="16" height="16">
                                <use xlink:href="#unchecked"></use>
                            </svg>
                            до 10 років
                        </a>
                    </li>
                    <li>
                        <a href="" class="btn p-0 d-flex align-items-center gap-2">
                            <svg width="16" height="16">
                                <use xlink:href="#unchecked"></use>
                            </svg>
                            до 20 років
                        </a>
                    </li>
                    <li>
                        <a href="" class="btn p-0 d-flex align-items-center gap-2">
                            <svg width="16" height="16">
                                <use xlink:href="#unchecked"></use>
                            </svg>
                            до 30 років
                        </a>
                    </li>
                    <li>
                        <a href="" class="btn p-0 d-flex align-items-center gap-2">
                            <svg width="16" height="16">
                                <use xlink:href="#unchecked"></use>
                            </svg>
                            до 45 років
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="mb-3">
            <h5>Країна</h5>
            <div>
                <ul class="p-0" style="list-style: none">
                    <?php foreach ($brands as $brand) : ?>
                        <li>
                            <a href="" class="btn p-0 d-flex align-items-center gap-2">
                                <svg width="16" height="16">
                                    <use xlink:href="#unchecked"></use>
                                </svg>
                                <?= $brand['Country'] ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </aside>

    <div class="col-10 row row-cols-1 row-cols-md-4">
        <?php foreach ($joinedProductWithCategory as $item): ?>

            <div class="col mb-3">
                <div class="card h-100 pt-3 pb-2" style="justify-content: space-between">
                    <a href="/products/view/<?= $item['ProductId'] ?>" style="text-decoration: none; color: black; display: flex; flex-direction: column; flex: 1 1 auto;">
                        <?php $filePath = 'files/products/' . $item['Image']; ?>
                        <?php if (is_file($filePath)): ?>
                            <img style="object-fit: contain; height: 300px" src="/<?= $filePath ?>" class="card-img-top" alt="">
                        <?php else: ?>
                            <img style="object-fit: contain; height: 300px" src="/static/images/no-image.jpg" class="card-img-top" alt="">
                        <?php endif; ?>

                        <div class="card-body pt-3 px-2 pb-0">
                            <h5 class="card-title fs-6 fw-0" style="font-weight: 400">
                                <?= $item['CategoryName'] ?>
                                <?= $item['Name'] ?>
                                <?= $item['Volume'] . ' л' ?>
                                <?= $item['Strength'] . '%' ?>
                            </h5>
                        </div>

                        <div class="text-danger fs-3 px-2" style="font-weight: 400;">
                            <?= $item['Price']?> <span class="fs-5">₴</span>
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
</div>

<script>
    function toggleBrand(brandName) {
        let currentUrl = window.location.href;
        let newUrl;

        if (currentUrl.includes('?brand=')) {
            let encodedBrandName = encodeURIComponent(brandName);
            let regex = new RegExp(`${encodedBrandName}(?:,|$)`, 'g');

            if (currentUrl.match(regex)) {
                newUrl = currentUrl.replace(regex, '');
            } else {
                newUrl = currentUrl + ',' + encodedBrandName + ',';
            }
        } else {
            let encodedBrandName = encodeURIComponent(brandName);
            newUrl = '?brand=' + encodedBrandName;
        }

        newUrl = newUrl.replace(/,,/g, ',');
        newUrl = newUrl.replace(/,$/, '');

        window.location.href = newUrl;
    }
</script>
