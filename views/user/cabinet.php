<?php

/** @var array $currentUser */
/** @var array $genders */

?>

<h1 class="mt-4 mb-5">Особистий кабінет</h1>

<a href="/user/edit" class="btn btn-primary">Редагувати інформацію</a>

<div class="mt-4">
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>Email</th>
            <th>Login</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Birth date</th>
            <th>Gender</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th><?= $currentUser['Email'] ?></th>
            <th><?= $currentUser['Login'] ?></th>
            <th><?= $currentUser['Firstname'] ?></th>
            <th><?= $currentUser['Lastname'] ?></th>
            <th><?= $currentUser['BirthDate'] ?></th>
            <th>
                <?php foreach ($genders as $gender) {
                    if ($gender['GenderId'] == $currentUser['GenderId'])
                        echo $gender['Name'];
                 }
                ?>
            </th>
        </tr>
        </tbody>
    </table>
</div>
