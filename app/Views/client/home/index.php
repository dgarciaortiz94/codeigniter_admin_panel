<?= $this->extend('client_layout') ?>

<?= $this->section('stylesheets') ?>
    <link rel="stylesheet" href="<?=base_url().'/assets/css/home.css'?>">
<?= $this->endSection() ?>

<?= $this->section('section') ?>
    <div class="row bg-dark p-4 mt-5">
        <div class="col-12 col-md-8">
            <video class="w-100" src="<?=base_url().'/media/videos/enubes.mp4'?>" controls></video>
            <div class="bg-light">
                Información sobre el video
            </div>
        </div>
        <div class="col-12 col-md-4 d-flex flex-column justify-content-between">
            <div class="bg-primary" style="width: 100%; height: 150px;"></div>
            <div class="bg-secondary" style="width: 100%; height: 150px;"></div>
            <div class="bg-success" style="width: 100%; height: 150px;"></div>
        </div>
    </div>
<?= $this->endSection() ?>