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

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Оформити замовлення
    </button>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Для оформлення замовлення потрібно ввести свій номер телефону</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label class="form-label" for="phone">Номер телефону</label>
                    <input class="form-control" type="text" name="phone" id="phone" aria-describedby="phoneHelp" value="<?= $model['phone'] ?>">
                    <?php if (!empty($errors['phone'])): ?>
                        <div id="phoneHelp" class="form-text text-danger"><?php echo $errors['phone'] ?></div>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрити</button>
                    <a class="btn btn-primary " href="#" id="submitOrder">Підтвердити</a>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<script defer>
    const button =  document.getElementById("submitOrder");
    const phoneInput =  document.getElementById("phone");
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

    button.addEventListener('click', () => {
        let productNames = [];
        let productPrices = [];
        let productCounts = [];

        productsData.forEach(function (product) {
            productNames.push(product.name);
            productPrices.push(product.price);
            productCounts.push(product.count);
        });

        const queryParams = `productNames=${productNames.join(',')}&productPrices=${productPrices.join(',')}&productCounts=${productCounts.join(',')}&phone=${phoneInput.value}`;

        // Складіть URL для відправки GET-запиту
        button.href = `/orderItems/add?${queryParams}`;
    });
</script>

