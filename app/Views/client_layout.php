<?= $this->extend('base') ?>

<?= $this->section('stylesheets') ?>
    <link rel="stylesheet" href="<?=base_url().'/assets/css/client_layout.css'?>">
<?= $this->endSection() ?>

<?= $this->section('body') ?>
    <header class="header bg-dark">
        <div class="container-fluid d-flex justify-content-between">
            <div class="d-flex align-items-center">
                <?php if (session('is_logged')) { ?>
                    <a href="<?=base_url().route_to('client_home')?>"><img src="<?=base_url().'/media/website/logo.png'?>" alt="Enubes" style="max-width: 150px;"></a>
                <?php } else { ?>
                    <img src="<?=base_url().'/media/website/logo.png'?>" alt="Enubes" style="max-width: 150px;">
                <?php } ?>
            </div>
            <?= view('client/inc/navbar.php') ?>
        </div>
    </header>

    <div class="container">
        <section class="section">
            <?= $this->renderSection('section') ?>
        </section>
    </div>

    <footer class="footer bg-light">

    </footer>
<?= $this->endSection() ?>