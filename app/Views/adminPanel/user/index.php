<?= $this->extend('admin_layout') ?>

<?= $this->section('stylesheets') ?>
    <link rel="stylesheet" href="<?=base_url().'/assets/css/user.css'?>">
<?= $this->endSection() ?>

<?= $this->section('section') ?>
    <div class="w-100">
        <div>
            <div class="display-4">Usuarios</div>
        </div>

        <div class="table-wrapper">
            <table class="table mt-5">
                <thead class="bg-warning">
                    <th></th>
                    <th></th>
                    <th>Role</th>
                    <th>Registro</th>
                    <th>Actualizado</th>
                    <th>Activo</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </thead>

                <tbody>
                    <?php foreach ($users as $user) { ?>
                        <tr>
                            <td><div class="profile-img" style="background-image: url(<?=base_url().'/media/users/'.$user->image?>);"></div></td>
                            <td>
                                <div>
                                    <a href="<?=base_url() . route_to('admin_panel_user_show', $user->id)?>">
                                        <div><?=$user->name . " " . $user->firstname . " " . $user->lastname?></div>
                                    </a>
                                    <div style="font-size: 0.8em;"><?=$user->email?></div>
                                </div>
                            </td>
                            <td><?=$user->role?></td>
                            <td><?=$user->created_at?></td>
                            <td><?=$user->updated_at?></td>
                            <td><?=$user->active?></td>
                            <td><a href="<?=base_url() . route_to('admin_panel_user_edit', $user->id)?>"><i class="bi bi-pencil-square text-warning"></i></a></td>
                            <td><a href="<?=base_url() . route_to('admin_panel_user_delete', $user->id)?>"><i class="bi bi-folder-x text-danger"></i></a></td>
                            <td></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-start w-100">
            <a href="<?=base_url() . route_to('admin_panel_user_new')?>"><button class="btn btn-primary"><i class="bi bi-plus-lg"></i> Añadir usuario</button></a>
        </div>
    </div>
<?= $this->endSection() ?>