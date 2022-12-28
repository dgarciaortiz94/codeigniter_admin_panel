<?= $this->extend('admin_layout') ?>

<?= $this->section('stylesheets') ?>
    <link rel="stylesheet" href="<?=base_url().'/assets/css/login.css'?>">
<?= $this->endSection() ?>

<?= $this->section('section') ?>
    <div class="w-100">
        <div>
            <div class="display-4">Videos</div>
        </div>

        <div class="table-wrapper">
            <table class="table mt-5">
                <thead class="bg-warning">
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Ruta</th>
                    <th>Creación</th>
                    <th>Actualizado</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </thead>

                <tbody>
                    <?php foreach ($videos as $video) { ?>
                        <tr>
                            <td><a href="<?=base_url() . route_to('admin_panel_video_show', $video->id)?>"><?=$video->title?></a></td>
                            <td><?=$video->description?></td>
                            <td><?=$video->path?></td>
                            <td><?=$video->created_at?></td>
                            <td><?=$video->updated_at?></td>
                            <td><a href="<?=base_url() . route_to('admin_panel_video_edit', $video->id)?>">edit</a></td>
                            <td><a href="<?=base_url() . route_to('admin_panel_video_delete', $video->id)?>">delete</a></td>
                            <td></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-start w-100">
        <a href="<?=base_url() . route_to('admin_panel_video_new')?>"><button class="btn btn-primary"><i class="bi bi-plus-lg"></i> Añadir video</button></a>
    </div>
<?= $this->endSection() ?>