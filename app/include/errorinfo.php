<?php if (count($errorMessage) > 0) : ?>
    <?php foreach ($errorMessage as $error): ?>
        <li> <?= $error; ?> </li>
    <?php endforeach; ?>
<?php endif; ?>
