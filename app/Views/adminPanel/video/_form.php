<form class="form form-login" action="<?=base_url().route_to('admin_panel_video_new')?>" method="post" enctype="multipart/form-data">
    <input name="title" type="text" class="form-control" placeholder="Título del video" value="<?php if(isset($video)) echo $video->title ?>">
    <textarea name="description" class="form-control"></textarea>
    <input type="file" name="video">
    <input type="submit" value="Enviar" class="btn btn-primary">
</form>