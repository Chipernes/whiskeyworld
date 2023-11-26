<?php
/** @var array $users */
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
                <th><?= $user['Gender'] ?></th>
                <th><?= $user['AccessLevel'] ?></th>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
