<?php if (isset($errors) && count($errors) > 0) { ?>
    <div class="flash-error">
        <?= $errors[0] ?>
    </div>
<?php } ?>

<form method="post">
    <input name="email" type="email" class="form-control" placeholder="Email">
    <input name="password" type="password" class="form-control" placeholder="Contraseña">
    <input type="submit" class="btn btn-primary" value="Entrar">
</form>