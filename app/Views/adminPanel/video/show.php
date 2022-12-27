<?= $this->extend('admin_layout') ?>

<?= $this->section('stylesheets') ?>
    <link rel="stylesheet" href="<?=base_url().'/assets/css/user.css'?>">
<?= $this->endSection() ?>

<?= $this->section('section') ?>
    <div class="user-card mt-5 bg-warning">
        <div class="d-flex justify-content-center">
            <video src="<?=base_url().'/media/videos/'.$video->path?>" controls></video>
        </div>
        <table class="table">
            <tr>
                <th>Título</th>
                <td><?=$video->name?></td>
            </tr>
            <tr>
                <th>Descripción</th>
                <td><?=$video->description?></td>
            </tr>
            <tr>
                <th>Ruta</th>
                <td><?=$video->path?></td>
            </tr>
            <tr>
                <th>Creación</th>
                <td><?=$video->created_at?></td>
            </tr>
            <tr>
                <th>Actualizado</th>
                <td><?=$video->updated_at?></td>
            </tr>
        </table>
    </div>
<?= $this->endSection() ?>