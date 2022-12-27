<form action="<?=base_url() . route_to('client_user_new')?>" method="post">
    <input name="name" type="text" class="form-control" placeholder="Nombre">
    <input name="firstname" type="text" class="form-control" placeholder="Primer apellido">
    <input name="lastname" type="text" class="form-control" placeholder="Segundo apellido">
    <input name="email" type="text" class="form-control" placeholder="Email">
    <input name="password" type="password" class="form-control" placeholder="Contraseña">
    <input name="repeatPassword" type="password" class="form-control" placeholder="Repetir contraseña">
    <input type="submit" value="Enviar" class="btn btn-primary">
</form>