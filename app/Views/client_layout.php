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
    <?= view('client/inc/navbar-mobile.php') ?>

    <div class="container">
        <section class="section">
            <?= $this->renderSection('section') ?>
        </section>
    </div>

    <footer class="footer bg-light text-center">
        <div class="container-fluid">
            <div class="row py-4">
                <div class="footer__nav col-12 col-md-3 col-lg-4">
                    <nav class="row">
                        <?php if (session('is_logged')) { ?>
                            <div class="col-12 col-sm-2 col-md-12 py-1"><a href="<?=base_url().route_to('client_home')?>">Home</a></div>
                        <?php } ?>
                        <?php if (session('is_logged') && '["ROLE_ADMIN"]' == session('user')->role) { ?>
                            <div class="col-12 col-sm-2 col-md-12 py-1"><a href="<?=base_url().route_to('admin_panel_user_index')?>">Usuarios</a></div>
                            <div class="col-12 col-sm-2 col-md-12 py-1"><a href="<?=base_url().route_to('admin_panel_video_index')?>">Videos</a></div>
                        <?php } ?>
                        <?php if (session('is_logged')) { ?>
                            <div class="col-12 col-sm-3 col-md-12 py-1"><a href="<?=base_url().route_to('client_profile')?>">Editar perfil</a></div>
                            <div class="col-12 col-sm-3 col-md-12 py-1"><a href="<?=base_url().route_to('logout')?>">Cerrar sesión</a></div>
                        <?php } ?>
                    </nav>
                </div>
                <div class="footer__info col-12 col-md-6 col-lg-4 px-md-3 px-lg-0">
                    <p>
                        Este proyecto es una prueba técnica realizada por Diego garcía para la empresa ENUBES COMUNICACION SL.
                        Este es un proyecto de código abierto bajo licencia MIT.
                    </p>
                    <p>
                        Si quieres conocer más detalles acerca de esta licencia puedes consultarlos <a href="https://choosealicense.com/licenses/mit/" target="_blank">aquí.</a>
                    </p>
                </div>
                <div class="col-12 col-md-3 col-lg-4">
                    <img src="<?=base_url().'/media/website/logo.png'?>" alt="Enubes" style="max-width: 120px;">
                </div>
            </div>
        </div>
        <div class="footer__copyright">© Diego García Ortiz</div>
    </footer>
<?= $this->endSection() ?>