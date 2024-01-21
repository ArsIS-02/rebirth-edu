<?php

/*!
* ifsoft.co.uk
*
* http://ifsoft.com.ua, https://ifsoft.co.uk, https://raccoonsquare.com
* raccoonsquare@gmail.com
*
* Copyright 2012-2020 Demyanchuk Dmitry (raccoonsquare@gmail.com)
*/

if (!defined("APP_SIGNATURE")) {

    header("Location: /");
    exit;
}

?>

<?php

if (APP_DEMO) {

    ?>

    <div class="card">
        <div class="card-body collapse show">
            <h4 class="card-title">Demo version!</h4>
            <p class="card-text">Warning! Enabled demo version mode! The changes you've made will not be saved.</p>
        </div>
    </div>

    <?php
}
?>