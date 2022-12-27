<?= $this->extend('admin_layout') ?>

<?= $this->section('stylesheets') ?>
    <link rel="stylesheet" href="<?=base_url().'/assets/css/login.css'?>">
<?= $this->endSection() ?>

<?= $this->section('section') ?>
    <?= view('adminPanel/user/_form') ?>
<?= $this->endSection() ?>