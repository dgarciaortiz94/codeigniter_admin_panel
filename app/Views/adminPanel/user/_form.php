<form class="form form-login" action="" method="post" enctype="multipart/form-data">
    <input type="file" name="image" class="form-control">
    <input name="name" type="text" class="form-control" placeholder="Nombre" value="<?php if(isset($user)) echo $user->name ?>">
    <input name="firstname" type="text" class="form-control" placeholder="Primer apellido" value="<?php if(isset($user)) echo $user->firstname ?>">
    <input name="lastname" type="text" class="form-control" placeholder="Segundo apellido" value="<?php if(isset($user)) echo $user->lastname ?>">
    <input name="email" type="email" class="form-control" placeholder="Email" value="<?php if(isset($user)) echo $user->email ?>">
    <input name="plainPassword" type="password" class="form-control" placeholder="Contraseña">
    <input type="submit" value="Enviar" class="btn btn-primary">
</form>