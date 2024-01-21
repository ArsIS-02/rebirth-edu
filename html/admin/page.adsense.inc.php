<?php



    if (!defined("APP_SIGNATURE")) {

        header("Location: /");
        exit;
    }

    if (!admin::isSession()) {

        header("Location: /admin/login");
        exit;
    }

    $error = false;
    $error_message = '';

    $stats = new stats($dbo);
    $admin = new admin($dbo);

    $f_adsense_wide_block = "../html/common/adsense_wide.inc.php";
    $f_adsense_square_block = "../html/common/adsense_square.inc.php";
    $f_adsense_vertical_block = "../html/common/adsense_vertical.inc.php";

    $adsense_wide = "";
    $adsense_square = "";
    $adsense_vertical = "";

    if (!empty($_POST)) {

        $accessToken = isset($_POST['access_token']) ? $_POST['access_token'] : '';
        $adsense_wide = isset($_POST['adsense_wide']) ? $_POST['adsense_wide'] : '';
        $adsense_square = isset($_POST['adsense_square']) ? $_POST['adsense_square'] : '';
        $adsense_vertical = isset($_POST['adsense_vertical']) ? $_POST['adsense_vertical'] : '';

        if ($accessToken === admin::getAccessToken() && !APP_DEMO) {

            if (strlen($adsense_wide) != 0) {

                $adsense_wide = mb_convert_encoding($adsense_wide, 'UTF-8', 'OLD-ENCODING');
                file_put_contents($f_adsense_wide_block, $adsense_wide);

            } else {

                if (file_exists($f_adsense_wide_block)) {

                    unlink($f_adsense_wide_block);
                }
            }

            if (strlen($adsense_square) != 0) {

                $adsense_square = mb_convert_encoding($adsense_square, 'UTF-8', 'OLD-ENCODING');
                file_put_contents($f_adsense_square_block, $adsense_square);

            } else {

                if (file_exists($f_adsense_square_block)) {

                    unlink($f_adsense_square_block);
                }
            }

            if (strlen($adsense_vertical) != 0) {

                $adsense_vertical = mb_convert_encoding($adsense_vertical, 'UTF-8', 'OLD-ENCODING');
                file_put_contents($f_adsense_vertical_block, $adsense_vertical);

            } else {

                if (file_exists($f_adsense_vertical_block)) {

                    unlink($f_adsense_vertical_block);
                }
            }
        }
    }

    if (file_exists($f_adsense_wide_block)) {

        $adsense_wide = file_get_contents($f_adsense_wide_block);
    }

    if (file_exists($f_adsense_square_block)) {

        $adsense_square = file_get_contents($f_adsense_square_block);
    }

    if (file_exists($f_adsense_vertical_block)) {

        $adsense_vertical = file_get_contents($f_adsense_vertical_block);
    }

    $page_id = "adsense";

    $error = false;
    $error_message = '';

    helper::newAuthenticityToken();

    $css_files = array("mytheme.css");
    $page_title = "Adsense | Admin Panel";

    include_once("../html/common/admin_header.inc.php");
?>

<body class="fix-header fix-sidebar card-no-border">

    <div id="main-wrapper">

        <?php

            include_once("../html/common/admin_topbar.inc.php");
        ?>

        <?php

            include_once("../html/common/admin_sidebar.inc.php");
        ?>

        <div class="page-wrapper">

            <div class="container-fluid">

                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor">Панель</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/admin/main">Главная</a></li>
                            <li class="breadcrumb-item active">Adsense</li>
                        </ol>
                    </div>
                </div>

                <?php
                    include_once("../html/common/admin_banner.inc.php");
                ?>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Блоки AdSense</h4>
                                <h6 class="card-subtitle">Добавьте код рекламного блока для показа рекламных блоков Google или удалите рекламный код, чтобы приостановить показ рекламы.</h6>
                                <h6 class="card-subtitle">Как создать рекламный блок и получить html-код читайте здесь: <a href="https://appbiz.ru/?p=1032&preview=true" target="_blank">https://appbiz.ru/?p=1032&preview=true</a></h6>

                                <form class="form-material m-t-40" method="post" action="/admin/adsense">

                                    <input type="hidden" name="access_token" value="<?php echo admin::getAccessToken(); ?>">

                                    <div class="form-group">
                                        <label class="pb-2">Горизонтальная реклама</label>
                                        <textarea class="form-control" name="adsense_wide" placeholder="Добавьте сюда горизонтальную рекламу..." style="height: 250px"><?php echo $adsense_wide; ?></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label class="pb-2">Квадратная реклама</label>
                                        <textarea class="form-control" name="adsense_square" placeholder="Добавьте сюда квадратную рекламу..." style="height: 250px"><?php echo $adsense_square; ?></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label class="pb-2">Вертикальная реклама</label>
                                        <textarea class="form-control" name="adsense_vertical" placeholder="Добавьте сюда вертикальную рекламу..." style="height: 250px"><?php echo $adsense_vertical; ?></textarea>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <button class="btn btn-info text-uppercase waves-effect waves-light" type="submit">Сохранить</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>


            </div> <!-- End Container fluid  -->

            <?php

                include_once("../html/common/admin_footer.inc.php");
            ?>

        </div> <!-- End Page wrapper  -->
    </div> <!-- End Wrapper -->

</body>

</html>
