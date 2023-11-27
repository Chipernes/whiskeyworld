<?php
use core\Core;
/** @var string $title */
/** @var string $errorText */

Core::getInstance()->pageParams['title'] = $title;
?>

<div class="alert alert-danger pt-4 pb-4 mt-5" role="alert">
    <h5 class="mb-0"><?= $errorText ?></h5>
</div>
