<?= $this->extend('base') ?>

<?= $this->section('stylesheets') ?>
    <link rel="stylesheet" href="<?=base_url().'/assets/css/admin_layout.css'?>">
<?= $this->endSection() ?>

<?= $this->section('body') ?>
    <header class="header bg-warning">
        <div class="container-fluid d-flex justify-content-between">
            <div class="d-flex align-items-center">
                <a href="<?=base_url().route_to('client_home')?>"><img src="<?=base_url().'/media/website/logo.png'?>" alt="Enubes" style="max-width: 150px;"></a>
            </div>
            <?= view('client/inc/navbar.php') ?>
        </div>
    </header>

    <div class="container">
        <section class="section">
            <?= $this->renderSection('section') ?>
        </section>
    </div>

    <footer class="footer bg-dark text-light">
        Este es el footer admin
    </footer>
<?= $this->endSection() ?>