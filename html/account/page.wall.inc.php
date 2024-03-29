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

    if (!$auth->authorize(auth::getCurrentUserId(), auth::getAccessToken())) {

        header('Location: /');
    }

    $feed = new feed($dbo);
    $feed->setRequestFrom(auth::getCurrentUserId());

    $inbox_all = $feed->count();
    $inbox_loaded = 0;

    if (!empty($_POST)) {

        $itemId = isset($_POST['itemId']) ? $_POST['itemId'] : '';
        $loaded = isset($_POST['loaded']) ? $_POST['loaded'] : '';

        $itemId = helper::clearInt($itemId);
        $loaded = helper::clearInt($loaded);

        $result = $feed->get($itemId);

        $inbox_loaded = count($result['items']);

        $result['inbox_loaded'] = $inbox_loaded + $loaded;
        $result['inbox_all'] = $inbox_all;

        if ($inbox_loaded != 0) {

            ob_start();

            foreach ($result['items'] as $key => $value) {

                draw::post($value, $LANG, $helper);
            }

            $result['html'] = ob_get_clean();

            if ($result['inbox_loaded'] < $inbox_all) {

                ob_start();

                ?>

                <header class="top-banner loading-banner">

                    <div class="prompt">
                        <button onclick="Items.more('/account/wall', '<?php echo $result['itemId']; ?>'); return false;" class="button more loading-button"><?php echo $LANG['action-more']; ?></button>
                    </div>

                </header>

                <?php

                $result['banner'] = ob_get_clean();
            }
        }

        echo json_encode($result);
        exit;
    }

    auth::newAuthenticityToken();

    $page_id = "wall";

    $css_files = array("main.css");
    $page_title = $LANG['page-wall']." | ".APP_TITLE;

    include_once("../html/common/header.inc.php");

?>

<body class="page-wall">


    <?php
        include_once("../html/common/topbar.inc.php");
    ?>

    <div class="wrap content-page">

        <div class="main-column row">

            <?php

                include_once("../html/common/sidenav.inc.php");
            ?>

            <div class="row col sn-content sn-content-sidebar-block" id="content">

                <div class="main-content">

                    <div class="main-content">

                        <div class="card">

                            <div class="card-header">
                                <h3 class="card-title"><?php echo $LANG['page-wall']; ?></h3>
                                <h5 class="card-description"><?php echo $LANG['page-news-description']; ?></h5>
                            </div>
                        </div>

                        <?php
                            include_once("../html/common/postform.inc.php");
                        ?>

                        <div class="content-list-page posts-list-page posts-list-page-bordered">

                            <?php

                            $result = $feed->get(0);

                            $inbox_loaded = count($result['items']);

                            if ($inbox_loaded != 0) {

                                ?>

                                <div class="items-list content-list">

                                    <?php

                                    $showed_ad = false;

                                    foreach ($result['items'] as $key => $value) {

                                        draw::post($value, $LANG, $helper);

                                        if (!$showed_ad) {

                                            $showed_ad = true;

                                            require_once ("../html/common/adsense_banner.inc.php");
                                        }
                                    }
                                    ?>

                                </div>

                                <?php

                            } else {

                                ?>

                                <div class="card information-banner">
                                    <div class="card-header">
                                        <div class="card-body">
                                            <header class="top-banner info-banner empty-list-banner">

                                            </header>
                                        </div>
                                    </div>
                                </div>

                                <?php
                            }
                            ?>

                            <?php

                            if ($inbox_all > 20) {

                                ?>

                                <header class="top-banner loading-banner">

                                    <div class="prompt">
                                        <button onclick="Items.more('/account/wall', '<?php echo $result['itemId']; ?>'); return false;" class="button more loading-button"><?php echo $LANG['action-more']; ?></button>
                                    </div>

                                </header>

                                <?php
                            }
                            ?>


                        </div>

                    </div>
                </div>

            </div>

            <?php

                include_once("../html/common/sidebar.inc.php");
            ?>

        </div>

    </div>

    <?php

        include_once("../html/common/footer.inc.php");
    ?>

    <script type="text/javascript">

        var inbox_all = <?php echo $inbox_all; ?>;
        var inbox_loaded = <?php echo $inbox_loaded; ?>;

        $("textarea[name=postText]").autosize();

        $("textarea[name=postText]").bind('keyup mouseout', function() {

            var max_char = 1000;

            var count = $("textarea[name=postText]").val().length;

            $("span#word_counter").empty();
            $("span#word_counter").html(max_char - count);

            event.preventDefault();
        });

    </script>


</body
</html>
