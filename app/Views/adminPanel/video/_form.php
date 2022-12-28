<form class="form form-login" action="" method="post" enctype="multipart/form-data">
    <?php if (isset($edit)) { ?>
        <div class="crud-title">
            <div class="crud-title__title">Editar</div>
            <div class="d-flex align-items-center">
                <a href="<?=base_url() . route_to('admin_panel_video_index')?>"><div><i class="bi bi-arrow-return-left text-dark"></i></div></a>
                <a href="<?=base_url() . route_to('admin_panel_video_show', $video->id)?>"><div><i class="bi bi-eye text-primary mx-3"></i></div></a>
                <a href="<?=base_url() . route_to('admin_panel_video_delete', $video->id)?>"><div><i class="bi bi-folder-x text-danger"></i></div></a>
            </div>
        </div>
    <?php } else { ?>
        <div class="crud-title">
            <div class="crud-title__title">Añadir</div>
            <div class="d-flex align-items-center">
                <a href="<?=base_url() . route_to('admin_panel_video_index')?>"><div><i class="bi bi-arrow-return-left text-dark"></i></div></a>
            </div>
        </div>
    <?php } ?>

    <input name="title" type="text" class="form-control" placeholder="Título del video*" value="<?php if(isset($video)) echo $video->title ?>" <?php if(! isset($edit)) echo "required" ?>>
    <textarea name="description" class="form-control"><?php if(isset($video)) echo $video->description ?></textarea>
    <input type="file" id="file" name="video" class="form-control" <?php if(! isset($edit)) echo "required" ?>>
    <input type="submit" value="Enviar" class="btn btn-primary">
</form>