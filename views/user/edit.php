<?php
/** @var array $errors */
/** @var array $model */
/** @var array $genders */
?>

<h2 class="mt-3 mb-4 fs-1">Редагування особистої інформації</h2>

<form action="" method="post">
    <div class="mb-3">
        <label class="form-label" for="email">Електронна пошта</label>
        <input class="form-control" type="email" name="email" id="email" aria-describedby="emailHelp" value="<?= $model['Email'] ?>">
        <?php if (!empty($errors['email'])): ?>
            <div id="emailHelp" class="form-text text-danger"><?php echo $errors['email'] ?></div>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label class="form-label" for="login">Логін</label>
        <input class="form-control" type="text" name="login" id="login" aria-describedby="loginHelp" value="<?= $model['Login'] ?>">
        <?php if (!empty($errors['login'])): ?>
            <div id="loginHelp" class="form-text text-danger"><?php echo $errors['login'] ?></div>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label class="form-label" for="password">Старий пароль</label>
        <input class="form-control" type="password" name="password" id="password" aria-describedby="passwordHelp">
        <?php if (!empty($errors['password'])): ?>
            <div id="passwordHelp" class="form-text text-danger"><?php echo $errors['password'] ?></div>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label class="form-label" for="passwordNew">Новий пароль</label>
        <input class="form-control" type="password" name="passwordNew" id="passwordNew" aria-describedby="passwordNewHelp">
        <?php if (!empty($errors['password'])): ?>
            <div id="passwordHelp" class="form-text text-danger"><?php echo $errors['password'] ?></div>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label class="form-label" for="firstname">Ім'я</label>
        <input class="form-control" type="text" name="firstname" id="firstname" aria-describedby="firstnameHelp" value="<?= $model['Firstname'] ?>">
        <?php if (!empty($errors['firstname'])): ?>
            <div id="firstnameHelp" class="form-text text-danger"><?php echo $errors['firstname'] ?></div>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label class="form-label" for="lastname">Прізвище</label>
        <input class="form-control" type="text" name="lastname" id="lastname" aria-describedby="lastnameHelp" value="<?= $model['Lastname'] ?>">
        <?php if (!empty($errors['lastname'])): ?>
            <div id="lastnameHelp" class="form-text text-danger"><?php echo $errors['lastname'] ?></div>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label class="form-label" for="birthDate">Дата народження</label>
        <input class="form-control" type="date" name="birthDate" id="birthDate" aria-describedby="birthDateHelp" value="<?= $model['BirthDate'] ?>">
        <?php if (!empty($errors['birthDate'])): ?>
            <div id="firstnameHelp" class="form-text text-danger"><?php echo $errors['birthDate'] ?></div>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label class="form-label" for="gender">Стать</label>
        <select class="form-control" id="gender" name="genderId" aria-describedby="genderHelp">
            <?php foreach ($genders as $gender): ?>
                <option <?php if ($model['GenderId'] == $gender['GenderId']) echo 'selected'; ?> value="<?= $gender['GenderId'] ?>"><?= $gender['Name'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Зберегти</button>
</form>

