<?= $this->extend('client_layout') ?>

<?= $this->section('stylesheets') ?>
    <link rel="stylesheet" href="<?=base_url().'/assets/css/login.css'?>">
<?= $this->endSection() ?>

<?= $this->section('section') ?>
    <form class="form form-login" action="" method="post">
        <?= view('inc/flash_messages') ?>

        <input name="name" type="text" class="form-control" placeholder="Nombre">
        <input name="firstname" type="text" class="form-control" placeholder="Primer apellido">
        <input name="lastname" type="text" class="form-control" placeholder="Segundo apellido">
        <input name="email" type="email" class="form-control" placeholder="Email">
        <input name="plainPassword" type="password" class="form-control" placeholder="Contraseña">
        <input type="submit" value="Enviar">
    </form>
<?= $this->endSection() ?>