<?php
/** @var array $users */
/** @var array $currentAuthenticatedUser */
/** @var array $genders */
?>

<h1 class="mt-4 mb-5">Список всіх користувачів магазину</h1>

<div class="mt-4">
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>№</th>
            <th>Email</th>
            <th>Login</th>
            <th>Password</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Birth date</th>
            <th>Gender</th>
            <th>Access level</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <th><?= $user['UserId'] ?></th>
                <th><?= $user['Email'] ?></th>
                <th><?= $user['Login'] ?></th>
                <th><?= md5($user['Password']) ?></th>
                <th><?= $user['Firstname'] ?></th>
                <th><?= $user['Lastname'] ?></th>
                <th><?= $user['BirthDate'] ?></th>
                <th>
                    <?php foreach ($genders as $gender) {
                        if ($gender['GenderId'] == $user['GenderId'])
                            echo $gender['Name'];
                    }
                    ?>
                </th>
                <th>
                    <?php if ($currentAuthenticatedUser['Login'] == 'Admin') : ?>
                        <?php if ($user['AccessLevel'] == 10): ?>
                            <a href="user/deleteAdmin?user=<?= $user['UserId'] ?>" class="btn">
                                <svg class="bi d-block mx-auto mb-1" width="16" height="16">
                                    <use xlink:href="#delete-admin"></use>
                                </svg>
                            </a>
                        <?php else: ?>
                            <a href="user/setAdmin?user=<?= $user['UserId'] ?>" class="btn">
                                <svg class="bi d-block mx-auto mb-1" width="16" height="16">
                                    <use xlink:href="#set-admin"></use>
                                </svg>
                            </a>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?= $user['AccessLevel'] ?>
                </th>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
