<?php

use models\User;

?>

<h1>Список товарів</h1>
<?php if (User::isAdmin()): ?>
    <a href="/products/add" class="btn btn-success mt-3 mb-4">Додати товар</a>
<?php endif; ?>
