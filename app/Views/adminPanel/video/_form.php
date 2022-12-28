<form class="form form-login" action="" method="post" enctype="multipart/form-data">
    <input name="title" type="text" class="form-control" placeholder="Título del video*" value="<?php if(isset($video)) echo $video->title ?>" <?php if(! isset($edit)) echo "required" ?>>
    <textarea name="description" class="form-control"><?php if(isset($video)) echo $video->description ?></textarea>
    <input type="file" id="file" name="video" class="form-control" <?php if(! isset($edit)) echo "required" ?>>
    <input type="submit" value="Enviar" class="btn btn-primary">
</form>