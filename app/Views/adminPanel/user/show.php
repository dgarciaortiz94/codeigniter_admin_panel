<?= $this->extend('admin_layout') ?>

<?= $this->section('stylesheets') ?>
    <link rel="stylesheet" href="<?=base_url().'/assets/css/user.css'?>">
<?= $this->endSection() ?>

<?= $this->section('section') ?>
    <div class="user-card mt-5 bg-warning">
        <div class="d-flex justify-content-center">
            <div class="user-card__profile-img" style="background-image: url(<?=base_url().'/media/users/'.session('user')->image?>);"></div>
        </div>
        <div class="table-wrapper">
            <table class="table">
                <tr>
                    <th>Nombre</th>
                    <td><?=$user->name?></td>
                </tr>
                <tr>
                    <th>Primer apellido</th>
                    <td><?=$user->firstname?></td>
                </tr>
                <tr>
                    <th>Segundo apellido</th>
                    <td><?=$user->lastname?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?=$user->email?></td>
                </tr>
                <tr>
                    <th>Role</th>
                    <td><?=$user->role?></td>
                </tr>
                <tr>
                    <th>Registro</th>
                    <td><?=$user->created_at?></td>
                </tr>
                <tr>
                    <th>Actualizado</th>
                    <td><?=$user->updated_at?></td>
                </tr>
            </table>
        </div>
    </div>
<?= $this->endSection() ?>