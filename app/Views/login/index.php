<?= $this->extend('client_layout') ?>

<?= $this->section('stylesheets') ?>
    <link rel="stylesheet" href="<?=base_url().'/assets/css/login.css'?>">
<?= $this->endSection() ?>

<?= $this->section('section') ?>
    <?php if (isset($errors) && count($errors) > 0) { ?>
        <div class="flash-error">
            <?= $errors[0] ?>
        </div>
    <?php } ?>

    <form method="post" class="form form-login">
        <input name="email" type="email" class="form-control" placeholder="Email">
        <input name="password" type="password" class="form-control" placeholder="Contraseña">
        <input type="submit" value="Entrar">

        <div class="form-login__register">Si aun no estás registrado puedes hacerlo <a href="<?=base_url().route_to('register_index')?>">aquí</a></div>
    </form>
<?= $this->endSection() ?>