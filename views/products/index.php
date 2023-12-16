<?php

/** @var array $brands*/
/** @var array $products*/
/** @var array $groupedProductsByTypes*/
/** @var array $groupedProductsByValues*/
/** @var array $groupedCountries*/
/** @var array $joinedProductWithCategory*/
/** @var array $filteredProducts*/

use models\User;

$brandsNames = explode(',', $_GET['brand']);
$typesNames = explode(',', $_GET['type']);
$valuesNames = explode(',', $_GET['value']);
$aging = explode(',', $_GET['aging']);
$countriesNames = explode(',', $_GET['country']);
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
                                    <?php if (in_array($brand['Name'], $brandsNames)): ?>
                                        <use xlink:href="#checked"></use>
                                    <?php else: ?>
                                        <use xlink:href="#unchecked"></use>
                                    <?php endif; ?>
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
                <label for="minPrice">Мінімальна ціна:</label>
                <input type="number" id="minPrice" name="minPrice" min="0" max="1000">
            </div>
            <div>
                <label for="maxPrice">Максимальна ціна:</label>
                <input type="number" id="maxPrice" name="maxPrice" min="0" max="1000">
            </div>
            <button onclick="applyPriceFilter()">Застосувати фільтр</button>
        </div>

        <div class="mb-3">
            <h5>Вид</h5>
            <div>
                <ul class="p-0" style="list-style: none">
                    <?php foreach ($groupedProductsByTypes as $groupedProductsByType) : ?>
                        <li>
                            <a href="javascript:void(0);" onclick="toggleType('<?= $groupedProductsByType['Type'] ?>')" class="btn p-0 d-flex align-items-center gap-2">
                                <svg width="16" height="16">
                                    <?php if (in_array($groupedProductsByType['Type'], $typesNames)): ?>
                                        <use xlink:href="#checked"></use>
                                    <?php else: ?>
                                        <use xlink:href="#unchecked"></use>
                                    <?php endif; ?>
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
                            <a href="javascript:void(0);" onclick="toggleValue('<?= $groupedProductsByValue['Volume'] ?>')" class="btn p-0 d-flex align-items-center gap-2">
                                <svg width="16" height="16">
                                    <?php if (in_array($groupedProductsByValue['Volume'], $valuesNames)): ?>
                                        <use xlink:href="#checked"></use>
                                    <?php else: ?>
                                        <use xlink:href="#unchecked"></use>
                                    <?php endif; ?>
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
                        <a href="javascript:void(0);" onclick="toggleAging('5')" class="btn p-0 d-flex align-items-center gap-2">
                            <svg width="16" height="16">
                                <?php if (in_array('5', $aging)): ?>
                                    <use xlink:href="#checked"></use>
                                <?php else: ?>
                                    <use xlink:href="#unchecked"></use>
                                <?php endif; ?>
                            </svg>
                            до 5 років
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" onclick="toggleAging('10')" class="btn p-0 d-flex align-items-center gap-2">
                            <svg width="16" height="16">
                                <?php if (in_array('10', $aging)): ?>
                                    <use xlink:href="#checked"></use>
                                <?php else: ?>
                                    <use xlink:href="#unchecked"></use>
                                <?php endif; ?>
                            </svg>
                            до 10 років
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" onclick="toggleAging('20')" class="btn p-0 d-flex align-items-center gap-2">
                            <svg width="16" height="16">
                                <?php if (in_array('20', $aging)): ?>
                                    <use xlink:href="#checked"></use>
                                <?php else: ?>
                                    <use xlink:href="#unchecked"></use>
                                <?php endif; ?>
                            </svg>
                            до 20 років
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" onclick="toggleAging('30')" class="btn p-0 d-flex align-items-center gap-2">
                            <svg width="16" height="16">
                                <?php if (in_array('30', $aging)): ?>
                                    <use xlink:href="#checked"></use>
                                <?php else: ?>
                                    <use xlink:href="#unchecked"></use>
                                <?php endif; ?>
                            </svg>
                            до 30 років
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" onclick="toggleAging('40')" class="btn p-0 d-flex align-items-center gap-2">
                            <svg width="16" height="16">
                                <?php if (in_array('40', $aging)): ?>
                                    <use xlink:href="#checked"></use>
                                <?php else: ?>
                                    <use xlink:href="#unchecked"></use>
                                <?php endif; ?>
                            </svg>
                            до 40 років
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="mb-3">
            <h5>Країна</h5>
            <div>
                <ul class="p-0" style="list-style: none">
                    <?php foreach ($groupedCountries as $groupedCountry) : ?>
                        <li>
                            <a href="javascript:void(0);" onclick="toggleCountry('<?= $groupedCountry['Country'] ?>')" class="btn p-0 d-flex align-items-center gap-2">
                                <svg width="16" height="16">
                                    <?php if (in_array($groupedCountry['Country'], $countriesNames)): ?>
                                        <use xlink:href="#checked"></use>
                                    <?php else: ?>
                                        <use xlink:href="#unchecked"></use>
                                    <?php endif; ?>
                                </svg>
                                <?= $groupedCountry['Country'] ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </aside>

    <div class="col-10 row row-cols-1 row-cols-md-4" style="height: 100%">
        <?php foreach ($filteredProducts as $item): ?>
            <?php if ($item['Visibility'] == 0 && !User::isAdmin()): ?>
                <div class="col mb-3" style="display: none">
            <?php else: ?>
                    <div class="col mb-3">
            <?php endif; ?>
                <div class="card h-100 pt-3 pb-2" style="justify-content: space-between">
                    <a href="/products/view/<?= $item['ProductId'] ?>" style="text-decoration: none; color: black; display: flex; flex-direction: column; flex: 1 1 auto;">
                        <?php if ($item['Visibility'] == 0 && User::isAdmin()): ?>
                            <div class="col mb-3" style="opacity: 0.5">
                        <?php endif; ?>

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
                        <?php if ($item['Visibility'] == 0 && User::isAdmin()): ?>
                            </div>
                        <?php endif; ?>


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
    function applyPriceFilter() {
        let minPrice = document.getElementById('minPrice').value;
        let maxPrice = document.getElementById('maxPrice').value;

        let currentUrl = window.location.href;
        let newUrl;

        let queryParams = new URLSearchParams(window.location.search);

        // Додати мінімальну ціну до параметрів
        if (minPrice !== '') {
            queryParams.set('minPrice', minPrice);
        } else {
            queryParams.delete('minPrice');
        }

        // Додати максимальну ціну до параметрів
        if (maxPrice !== '') {
            queryParams.set('maxPrice', maxPrice);
        } else {
            queryParams.delete('maxPrice');
        }

        // Видалити порожні параметри з URL
        Array.from(queryParams.keys())
            .filter(key => queryParams.get(key) === '')
            .forEach(emptyParam => queryParams.delete(emptyParam));

        // Додати всі інші параметри до URL
        let paramsString = Array.from(queryParams.keys())
            .map(key => key + '=' + queryParams.get(key))
            .join('&');

        newUrl = currentUrl.split('?')[0] + (paramsString ? '?' + paramsString : '');

        window.location.href = newUrl;
    }


    function toggleParameter(paramName, paramValue) {
        let currentUrl = window.location.href;
        let newUrl;

        let queryParams = new URLSearchParams(window.location.search);

        if (queryParams.has(paramName)) {
            let values = queryParams.get(paramName).split(',');
            let index = values.indexOf(paramValue);

            if (index !== -1) {
                values.splice(index, 1);
            } else {
                values.push(paramValue);
            }

            if (values.length > 0) {
                queryParams.set(paramName, values.join(','));
            } else {
                queryParams.delete(paramName);
            }
        } else {
            queryParams.append(paramName, paramValue);
        }

        // Видаляє порожні параметри з URL
        Array.from(queryParams.keys())
            .filter(key => queryParams.get(key) === '')
            .forEach(emptyParam => queryParams.delete(emptyParam));

        // Додати всі інші параметри до URL
        let paramsString = Array.from(queryParams.keys())
            .map(key => key + '=' + queryParams.get(key))
            .join('&');

        newUrl = currentUrl.split('?')[0] + (paramsString ? '?' + paramsString : '');

        window.location.href = newUrl;
    }

    // Використання функції для brand
    function toggleBrand(brandName) {
        toggleParameter('brand', brandName);
    }

    // Використання функції для type
    function toggleType(typeName) {
        toggleParameter('type', typeName);
    }

    // Використання функції для value
    function toggleValue(valueName) {
        toggleParameter('value', valueName);
    }

    // Використання функції для aging
    function toggleAging(aging) {
        toggleParameter('aging', aging);
    }

    // Використання функції для country
    function toggleCountry(countryName) {
        toggleParameter('country', countryName);
    }
</script>
