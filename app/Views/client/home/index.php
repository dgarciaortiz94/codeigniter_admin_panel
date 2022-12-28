<?= $this->extend('client_layout') ?>

<?= $this->section('stylesheets') ?>
    <link rel="stylesheet" href="<?= base_url() . '/assets/css/home.css' ?>">
<?= $this->endSection() ?>

<?= $this->section('section') ?>
    <div class="row bg-dark p-4 mt-5">
        <?php if (isset($videos[0])) { ?>
            <div class="col-12 col-lg-8">
                <video class="w-100" src="<?= base_url() . '/media/videos/'.$videos[0]->path ?>" controls></video>
                <div class="text-light">
                    <h2 style="font-family: Roboto-Bold;"><?= strtoupper($videos[0]->title) ?></h4>
                    <p><?= ucfirst($videos[0]->description) ?></p>
                </div>
            </div>
        <?php } else { ?>
            <div class="empty-video__box text-light col-12 col-lg-8">
                Proximamente...
            </div>
        <?php } ?>

        <div class="videos-asidebar col-12 col-lg-4 d-flex flex-column justify-content-between px-0 ps-lg-3 pe-lg-0 pt-4 pt-lg-0">
            <?php for ($i=1; $i < 4; $i++) {  ?>
                <?php if (isset($videos[$i])) { ?>
                    <div type="button" class="video__box" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        <video 
                            class="w-100" 
                            src="<?= base_url() . '/media/videos/'.$videos[$i]->path ?>"
                            data-path="<?=base_url() . '/media/videos/'.$videos[$i]->path?>"
                            data-title="<?=strtoupper($videos[$i]->title)?>"
                            data-description="<?=ucfirst($videos[$i]->description)?>"
                        >
                        </video>
                    </div>
                <?php } else { ?>
                    <div class="empty-video__box text-light">
                        Proximamente...
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content bg-dark">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <video class="w-100" src="" id="modal__video" controls></video>
                    <div class="text-light">
                        <div id="modal__title"></div>
                        <div id="modal__description"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>


<?= $this->section('jsInLine') ?>
<script>
    document.addEventListener('DOMContentLoaded', e => {
        const videos = document.querySelectorAll('.videos-asidebar video');

        for (const video of videos) {
            video.addEventListener('click', e => {
                const path = e.currentTarget.dataset.path;
                const title = e.currentTarget.dataset.title;
                const description = e.currentTarget.dataset.description;

                document.getElementById('modal__video').setAttribute('src', path);
                document.getElementById('modal__title').innerHTML = title;
                document.getElementById('modal__description').innerHTML = description;
            });
        }
    });
</script>
<?= $this->endSection() ?>