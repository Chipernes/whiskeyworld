<?php
/** @var array $product */
?>

<div class="alert alert-danger" role="alert">
    <h4 class="alert-heading">Видалити продукт "<?= $product['Name'] ?>"?</h4>
    <p>Після видалення продукту, всі дані зникнуть</b></p>
    <hr>
    <p class="mb-0">
        <a href="/products/delete/<?= $product['ProductId'] ?>/yes" class="btn btn-danger">Видалити</a>
        <a href="/categories/view/<?= $product['CategoryId'] ?>" class="btn btn-light">Відмінити</a>
    </p>
</div>
