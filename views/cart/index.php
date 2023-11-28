<?php
/** @var array $cart */

use core\Core;


?>

<h1 class="mt-4 mb-5">Кошик</h1>
<?php if (empty($cart)): ?>
    <div class="text-center">
        <img src="/static/images/empty-cart.svg" alt="Empty cart">
        <h2 class="mt-4">Кошик порожній</h2>
        <p class="mt-3">Але це ніколи не пізно виправити :)</p>
    </div>

<?php else: ?>

    <table class="table">
        <th>№</th>
        <th>Назва товару</th>
        <th>Вартість одиниці</th>
        <th>Кількість</th>
        <th>Загальна вартість</th>
        <th>Видалити</th>

        <?php
        $index = 1;
        foreach ($cart['products'] as $product): ?>
            <tr>
                <td><?= $index ?></td>
                <td><?= $product['products']['Name'] ?></td>
                <td><?= $product['products']['Price'] ?></td>
                <td>
                    <input class="form-control" type="number" max="<?= $product['products']['Count'] ?>"
                           value="<?= $product['count'] ?>">
                </td>
                <td><?= $product['products']['Price'] * $product['count'] ?></td>
                <td>
                    <a href="/cart/delete/<?= $product['products']['ProductId'] ?>"
                       class="btn-close bg-danger opacity-100 d-block" aria-label="Close"></a>
                </td>
            </tr>

            <?php
            $index += 1;
        endforeach; ?>

        <tr>
            <th></th>
            <th>Загальна сума</th>
            <th><?= $cart['totalPrice'] ?> грн</th>
        </tr>
    </table>
    <a class="btn btn-primary mt-3" href="#" id="submitOrder">Оформити замовлення</a>
<?php endif; ?>

<script defer>
    const button =  document.getElementById("submitOrder");
    // Отримайте дані з таблиці та підготуйте їх до відправки
    let productsData = [];
    const rows = document.querySelectorAll(".table tbody tr");

    for (let i = 1; i < rows.length - 1; i++) {
        let row = rows[i];
        let productData = {
            name: encodeURIComponent(row.cells[1].textContent),
            price: parseFloat(row.cells[2].textContent),
            count: parseInt(row.cells[3].querySelector("input").value),
        };
        productsData.push(productData);
    }

    const countInputs = document.querySelectorAll('.table tbody tr td input');

    let tbody = document.querySelector(".table tbody");
    tbody.addEventListener('input', (event) => {
        let target = event.target;
        let currentInputIndex = Array.from(countInputs).indexOf(target);
        productsData[currentInputIndex].count = target.value;
    });

    button.addEventListener('click', (event) => {
        let productNames = [];
        let productPrices = [];
        let productCounts = [];

        productsData.forEach(function (product) {
            productNames.push(product.name);
            productPrices.push(product.price);
            productCounts.push(product.count);
        });

        const queryParams = `productNames=${productNames.join(',')}&productPrices=${productPrices.join(',')}&productCounts=${productCounts.join(',')}`;

       /* let queryParams = 'products=';
        let productParams = [];
        productsData.forEach(function (product) {
            productParams.push(`${product.name},${product.price},${product.count}`);
        });
        queryParams += productParams.join(',');*/

        // Складіть URL для відправки GET-запиту
        button.href = `/orderItems/add?${queryParams}`;
    });
</script>

