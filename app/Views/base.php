<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ENUBES TEST</title>

    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href=<?=base_url()."/libraries/bootstrap-5/css/bootstrap.min.css"?>>
    <script src=<?=base_url()."/libraries/bootstrap-5/js/bootstrap.min.js"?>></script>

    <!-- ANIMATE CSS -->
    <link rel="stylesheet" href=<?=base_url()."/libraries/animate.css/animate.min.css"?>>

    <!-- STYLESHEETS AND JS FILES -->
    <link rel="stylesheet" href="<?=base_url().'/assets/css/main.css'?>">

    <?= $this->renderSection('stylesheets') ?>
    <?= $this->renderSection('javascripts') ?>
    <?= $this->renderSection('cssInLine') ?>
</head>
<body>
    <?= $this->renderSection('body') ?>

    <?= $this->renderSection('jsInLine') ?>
</body>
</html>