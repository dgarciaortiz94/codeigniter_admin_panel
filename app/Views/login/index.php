<?= $this->extend('client_layout') ?>

<?= $this->section('stylesheets') ?>
    <link rel="stylesheet" href="<?=base_url().'/assets/css/login.css'?>">
<?= $this->endSection() ?>

<?= $this->section('section') ?>
    <?php if (isset($errors) && count($errors) > 0) { ?>
        <div id="form-login__error animate__animated animate__shakeX" class="flash-error">
            <?= $errors[0] ?>
        </div>
    <?php } ?>

    <form id="form-login" method="post" class="form form-login">
        <input name="email" type="email" class="form-control" placeholder="Email">
        <input name="password" type="password" class="form-control" placeholder="Contraseña">
        <input type="submit" value="Entrar">

        <div class="form-login__register">Si aun no estás registrado puedes hacerlo <a href="<?=base_url().route_to('register_index')?>">aquí</a></div>
    </form>
<?= $this->endSection() ?>

<?= $this->section('jsInLine') ?>
<script>
    document.addEventListener('DOMContentLoaded', e => {
        const form = document.getElementById('form-login');
        const url = "<?=base_url().route_to('login')?>";
        const redirecTo = "<?=base_url().route_to('client_home')?>";

        form.addEventListener('submit', e => {
            e.preventDefault();

            if (document.getElementsByClassName('form-login__error')[0]) document.getElementsByClassName('form-login__error')[0].remove();

            let formData = new FormData(form);

            $.ajax({
                url : url,
                data : formData,
                type : 'POST',
                dataType : 'json',
                processData: false,
                contentType: false,
                success : function(response) {
                    if (response.success) window.location.href = redirecTo;
                    else { 
                        const formLoginError = document.createElement('div');
                        formLoginError.classList.add('form-login__error', 'animate__animated', 'animate__shakeX');
                        formLoginError.innerHTML = response.errors[0];

                        form.insertBefore(formLoginError, form.children[0]);
                    }
                },
                error : function(xhr, status) {
                    const formLoginError = document.createElement('div');
                    formLoginError.classList.add('form-login__error', 'animate__animated', 'animate__shakeX');
                    formLoginError.innerHTML = "Disculpe, existió un problema";

                    form.insertBefore(formLoginError, form.children[0]);
                }
            });
        });
    });
</script>
<?= $this->endSection() ?>