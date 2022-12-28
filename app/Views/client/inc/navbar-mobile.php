<nav class="navbar navbar-mobile bg-dark px-4 py-0 text-center position-absolute w-100 d-lg-none">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <?php if (session('is_logged')) { ?>
                <li class="nav-item dropdown pt-3">
                    <div class="d-flex flex-column justify-content-center align-items-center">
                        <div class="profile-img" style='background-image: url(<?=base_url().'/media/users/'.session('user')->image?>)'></div>
                        <a class="nav-link dropdown-toggle ps-3" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?=session('user')->name?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item text-light" href="<?=base_url().route_to('client_profile')?>">Editar perfil</a></li>
                            <li><a class="dropdown-item text-light" href="<?=base_url().route_to('logout')?>">Cerrar sesión</a></li>
                        </ul>
                    </div>
                </li>
            <?php } ?>
            <?php if (session('is_logged')) { ?>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?=base_url().route_to('client_home')?>">Home</a>
                </li>
            <?php } ?>
            <?php if (session('is_logged') && '["ROLE_ADMIN"]' == session('user')->role) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?=base_url().route_to('admin_panel_user_index')?>">Usuarios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=base_url().route_to('admin_panel_video_index')?>">Videos</a>
                </li>
            <?php } ?>
        </ul>
    </div>
</nav>