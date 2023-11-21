<?php
/** @var array $category */
/** @var array $product */
/** @var array $brand */
/** @var array $grapeVariety */
?>

<div class="container">
    <div class="row mt-5">
        <div class="col-6">
            <?php $filePath = 'files/products/' . $product['Image']; ?>
            <?php if (is_file($filePath)): ?>
                <img style="object-fit: contain; width: width: 200px; height: 600px" src="/<?= $filePath ?>"
                     class="card-img-top" alt="">
            <?php else: ?>
                <img style="object-fit: contain; width: width: 200px; height: 500px"
                     src="/static/images/no-image.jpg" class="card-img-top" alt="">
            <?php endif; ?>
        </div>
        <div class="col-6">
            <h1>
                <?= $category['Name'] ?>
                <?= $product['Name'] ?>
                <?= $product['Volume'] . ' л' ?>
                <?= $product['Strength'] . '%' ?>
            </h1>
            <div class="mb-3">
                <p class="fs-3">
                    Ціна: <strong class="text-danger"><?= $product['Price'] ?> грн</strong>
                </p>
            </div>
            <div class="mb-3">
                <a href="/cart/add/<?= $product['ProductId'] ?>" class="btn btn-success">Придбати</a>
            </div>
            <div>
                <h2 class="mt-4">Характеристики</h2>
                <table class="table">
                    <?php if (!empty($product['Type'])): ?>
                        <tr>
                            <td>Вид</td>
                            <td><?= $product['Type'] ?></td>
                        </tr>
                    <?php endif; ?>
                    <tr>
                        <td>Об'єм</td>
                        <td><?= $product['Volume'] ?></td>
                    </tr>
                    <?php if (!empty($product['Aging'])): ?>
                        <tr>
                            <td>Витримка</td>
                            <td><?= $product['Aging'] ?></td>
                        </tr>
                    <?php endif; ?>
                    <tr>
                        <td>Міцність</td>
                        <td><?= $product['Strength'] ?></td>
                    </tr>
                    <tr>
                        <td>Колір</td>
                        <td><?= $product['Color'] ?></td>
                    </tr>
                    <tr>
                        <td>Смак</td>
                        <td><?= $product['Taste'] ?></td>
                    </tr>
                    <?php if (!empty($product['GrapeVarietyId'])): ?>
                        <tr>
                            <td>Сорт винограду</td>
                            <td><?= $grapeVariety['Name'] ?></td>
                        </tr>
                    <?php endif; ?>
                    <?php if (!empty($product['BrandId'])): ?>
                        <tr>
                            <td>Бренд та країна походження</td>
                            <td><?= $brand['Name'] ?>, <?= $brand['Country'] ?></td>
                        </tr>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <h2>Опис</h2>
        <div class="mt-3">
            <?= $product['Description'] ?>
        </div>
    </div>
</div>

<script defer>
    const alertPlaceholder = document.getElementById('liveAlertPlaceholder')
    const appendAlert = (message, type) => {
        const wrapper = document.createElement('div')
        wrapper.innerHTML = [
            `<div class="alert alert-${type} alert-dismissible" role="alert">`,
            `   <div>${message}</div>`,
            '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
            '</div>'
        ].join('')

        alertPlaceholder.append(wrapper)
    }

    const alertTrigger = document.getElementById('liveAlertBtn')
    if (alertTrigger) {
        const inputCount = document.querySelector('input');
        alertTrigger.addEventListener('click', () => {
            appendAlert(`Супер! Товар був доданий у кошик!`, 'success')
        })
    }
</script>
