<?php if (isset($successes) && count($successes) > 0) { ?>
    <?php foreach ($successes as $success => $message) { ?>
        <div class="flash-success form-login__success animate__animated animate__fadeInUp">
            <?= $message ?>
        </div>
    <?php } ?>
<?php } ?>

<?php if (isset($warnings) && count($warnings) > 0) { ?>
    <?php foreach ($warnings as $warning => $message) { ?>
        <div class="flash-warning form-login__warning animate__animated animate__flash">
            <?= $message ?>
        </div>
    <?php } ?>
<?php } ?>

<?php if (isset($errors) && count($errors) > 0) { ?>
    <?php foreach ($errors as $error => $message) { ?>
        <div class="flash-error form-login__error animate__animated animate__shakeX">
            <?= $message ?>
        </div>
    <?php } ?>
<?php } ?>