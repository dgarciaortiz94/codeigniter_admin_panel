<?php

use Config\Services;

if (Services::session()->get('user')) { ?>
    <div class="bg-warning">
        <?= Services::session()->get('user')->email ?>
    </div>
<?php } ?>

<section>
    <h1 class="bg-primary">Este es mi body</h1>

    <h5>Esta será mi landing page</h5>
</section>