<form class="form form-login" action="" method="post" enctype="multipart/form-data">
    <?php if (isset($edit)) { ?>
        <div class="crud-title">
            <div class="crud-title__title">Editar</div>
            <div class="d-flex align-items-center">
                <a href="<?=base_url() . route_to('admin_panel_user_index')?>"><div><i class="bi bi-arrow-return-left text-dark"></i></div></a>
                <a href="<?=base_url() . route_to('admin_panel_user_show', $user->id)?>"><div><i class="bi bi-eye text-primary mx-3"></i></div></a>
                <a href="<?=base_url() . route_to('admin_panel_user_delete', $user->id)?>"><div><i class="bi bi-folder-x text-danger"></i></div></a>
            </div>
        </div>
    <?php } else { ?>
        <div class="crud-title">
            <div class="crud-title__title">Añadir</div>
            <div class="d-flex align-items-center">
                <a href="<?=base_url() . route_to('admin_panel_user_index')?>"><div><i class="bi bi-arrow-return-left text-dark"></i></div></a>
            </div>
        </div>
    <?php } ?>

    <input type="file" name="image" class="form-control" >
    <input name="name" type="text" class="form-control" placeholder="Nombre" value="<?php if(isset($user)) echo $user->name ?>" <?php if(! isset($edit)) echo "required" ?>>
    <input name="firstname" type="text" class="form-control" placeholder="Primer apellido" value="<?php if(isset($user)) echo $user->firstname ?>" <?php if(! isset($edit)) echo "required" ?>>
    <input name="lastname" type="text" class="form-control" placeholder="Segundo apellido" value="<?php if(isset($user)) echo $user->lastname ?>">
    <input name="email" type="email" class="form-control" placeholder="Email" value="<?php if(isset($user)) echo $user->email ?>" <?php if(! isset($edit)) echo "required" ?>>
    <input name="plainPassword" type="password" class="form-control" placeholder="Contraseña" <?php if(! isset($edit)) echo "required" ?>>
    <input type="submit" value="Enviar" class="btn btn-primary">
</form>