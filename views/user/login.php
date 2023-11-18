<?php
/** @var string|null $error */
/** @var array $model */
\core\Core::getInstance()->pageParams['title'] = 'Вхід на сайт';
?>

<h1 class="fs-2 mt-3 mb-4 text-center">Вхід на сайт</h1>
<main class="form-signin w-100 m-auto">
    <form action="" method="post">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" name="login" id="login" placeholder="name@example.com"
                   value="<?= $model['login'] ?>">
            <label for="login">Логін</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" name="password" id="password" placeholder="Password"
                   aria-describedby="passwordHelp">
            <label for="password">Пароль</label>
        </div>
        <?php if (!empty($error)): ?>
            <div id="passwordHelp" class="massage error mb-3 text-center form-text text-danger"><?= $error ?></div>
        <?php endif; ?>
        <button class="btn btn-primary w-100 py-2" type="submit">Увійти</button>
    </form>
</main>
