<?php
/** @var array $errors */
/** @var array $model */
\core\Core::getInstance()->pageParams['title'] = 'Реєстрація на сайті';
?>

<h1 class="fs-2 mt-3 mb-4 text-center">Реєстрація нового користувача</h1>
<main class="form-signin w-100 m-auto">
    <form action="" method="post">
        <div class="mb-3">
            <label class="form-label" for="email">Електронна пошта</label>
            <input class="form-control" type="email" name="email" id="email" aria-describedby="emailHelp" value="<?= $model['email'] ?>">
            <?php if (!empty($errors['email'])): ?>
                <div id="emailHelp" class="form-text text-danger"><?php echo $errors['email'] ?></div>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label class="form-label" for="login">Логін</label>
            <input class="form-control" type="text" name="login" id="login" aria-describedby="loginHelp" value="<?= $model['login'] ?>">
            <?php if (!empty($errors['login'])): ?>
                <div id="loginHelp" class="form-text text-danger"><?php echo $errors['login'] ?></div>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label class="form-label" for="password">Пароль</label>
            <input class="form-control" type="password" name="password" id="password" aria-describedby="passwordHelp">
            <?php if (!empty($errors['password'])): ?>
                <div id="passwordHelp" class="form-text text-danger"><?php echo $errors['password'] ?></div>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label class="form-label" for="passwordRepeat">Пароль (ще раз)</label>
            <input class="form-control" type="password" name="passwordRepeat" id="passwordRepeat" aria-describedby="passwordRepeatHelp">
            <?php if (!empty($errors['password'])): ?>
                <div id="passwordHelp" class="form-text text-danger"><?php echo $errors['password'] ?></div>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label class="form-label" for="firstname">Ім'я</label>
            <input class="form-control" type="text" name="firstname" id="firstname" aria-describedby="firstnameHelp" value="<?= $model['firstname'] ?>">
            <?php if (!empty($errors['firstname'])): ?>
                <div id="firstnameHelp" class="form-text text-danger"><?php echo $errors['firstname'] ?></div>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label class="form-label" for="lastname">Прізвище</label>
            <input class="form-control" type="text" name="lastname" id="lastname" aria-describedby="lastnameHelp" value="<?= $model['lastname'] ?>">
            <?php if (!empty($errors['lastname'])): ?>
                <div id="lastnameHelp" class="form-text text-danger"><?php echo $errors['passwordRepeat'] ?></div>
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary">Зареєструватися</button>
    </form>
</main>


