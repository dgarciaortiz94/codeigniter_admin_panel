<?= $this->extend('client_layout') ?>

<?= $this->section('stylesheets') ?>
    <link rel="stylesheet" href="<?=base_url().'/assets/css/login.css'?>">
<?= $this->endSection() ?>

<?= $this->section('section') ?>
    <?php if ($file) { ?>
        <div class="form-error">
            <?= dd($file) ?>
        </div>
    <?php } ?>

    <form class="form form-login" action="<?=base_url() . route_to('client_user_new')?>" method="post" enctype="multipart/form-data">
        <input type="file" name="image" class="form-control">
        <input name="name" type="text" class="form-control" placeholder="Nombre" value="<?php if($user) echo $user->name ?>">
        <input name="firstname" type="text" class="form-control" placeholder="Primer apellido" value="<?php if($user) echo $user->firstname ?>">
        <input name="lastname" type="text" class="form-control" placeholder="Segundo apellido" value="<?php if($user) echo $user->lastname ?>">
        <input name="email" type="text" class="form-control" placeholder="Email" value="<?php if($user) echo $user->email ?>">
        <input name="password" type="password" class="form-control" placeholder="Contraseña">
        <input name="repeatPassword" type="password" class="form-control" placeholder="Repetir contraseña">
        <input type="submit" value="Enviar" class="btn btn-primary">
    </form>
<?= $this->endSection() ?>