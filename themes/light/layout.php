<?php
/** @var string $title */
/** @var string $content */
/** @var string $siteName */
?>
<?php

use models\User;

if (User::isUserAuthenticated())
    $user = User::getCurrentAuthenticatedUser();
else
    $user = null;

?>

<!doctype html>
<html lang="ua">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $siteName ?> | <?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="/themes/light/css/style.css">
    <link rel="shortcut icon" href="/themes/light/img/favicon.ico" type="image/x-icon">
</head>
<body>
<?php include('svg.html') ?>
<header class="px-3 py-1 text-bg-dark border-bottom sticky-top">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between">

            <div class="col-md-3 mb-2 mb-md-0">
                <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none align-items-center gap-3">
                    <svg class="bi" width="65" height="65" role="img">
                        <use xlink:href="#logo"></use>
                    </svg>
                    <span class="fs-3 text-white text-uppercase font-weight-bold text-nowrap">Whiskey World</span>
                </a>
            </div>

            <ul class="nav col-12 col-lg-auto my-2 justify-content-center align-items-center my-md-0 text-small">
                <li>
                    <a href="/" class="nav-link text-white">
                        <svg class="bi d-block mx-auto mb-1" width="20" height="20">
                            <use xlink:href="#home"></use>
                        </svg>
                        Головна
                    </a>
                </li>
                <li>
                    <a href="/categories" class="nav-link text-white">
                        <svg class="bi d-block mx-auto mb-1" width="20" height="20">
                            <use xlink:href="#grid"></use>
                        </svg>
                        Категорії
                    </a>
                </li>
                <li>
                    <a href="/cart" class="nav-link text-white">
                        <svg class="bi d-block mx-auto mb-1" width="20" height="20">
                            <use xlink:href="#cart"></use>
                        </svg>
                        Кошик
                    </a>
                </li>
                <li>
                    <div class="text-end">
                        <?php if (User::isUserAuthenticated()): ?>
                            <a href="/user/logout" class="btn btn-primary">Вийти</a>
                        <?php else: ?>
                            <a href="/user/login" class="btn btn-outline-primary me-2">Увійти</a>
                            <a href="/user/register" class="btn btn-primary">Реєстрація</a>
                        <?php endif; ?>
                    </div>
                </li>
            </ul>

        </div>
    </div>
</header>


<main class="container">
    <?= $content ?>
</main>

<footer class="py-3 my-4">
    <ul class="nav justify-content-center border-bottom pb-3 mb-3">
        <li class="nav-item"><a href="/" class="nav-link px-2 text-body-secondary">Головна</a></li>
        <li class="nav-item"><a href="/categories" class="nav-link px-2 text-body-secondary">Категорії</a></li>
    </ul>
    <p class="text-center text-body-secondary">© 2023 Розробив Мотицький Нікіта (Chipernes)</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>
</html>
