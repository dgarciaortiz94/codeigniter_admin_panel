<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ENUBES TEST</title>

    <!-- JQUERY -->
    <script
    src="https://code.jquery.com/jquery-3.6.3.min.js"
    integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="
    crossorigin="anonymous"></script>

    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href=<?=base_url()."/libraries/bootstrap-5/css/bootstrap.min.css"?>>
    <script src=<?=base_url()."/libraries/bootstrap-5/js/bootstrap.min.js"?>></script>
    <link rel="stylesheet" href="<?=base_url().'/libraries/bootstrap-icons/bootstrap-icons.css'?>">

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