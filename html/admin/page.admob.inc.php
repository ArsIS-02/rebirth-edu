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
    $settings = new settings($dbo);
    $admin = new admin($dbo);

    $default = $settings->getIntValue("admob");

    if (isset($_GET['act'])) {

        $accessToken = isset($_GET['access_token']) ? $_GET['access_token'] : 0;
        $act = isset($_GET['act']) ? $_GET['act'] : '';

        if ($accessToken === admin::getAccessToken() && !APP_DEMO) {

            switch ($act) {

                case "global_off": {

                    $settings->setValue("admob", 0);

                    header("Location: /admin/admob");
                    break;
                }

                case "global_on": {

                    $settings->setValue("admob", 1);

                    header("Location: /admin/admob");
                    break;
                }

                case "on": {

                    $admin->setAdmobValueForAccounts(1);

                    header("Location: /admin/admob");
                    break;
                }

                case "off": {

                    $admin->setAdmobValueForAccounts(0);

                    header("Location: /admin/admob");
                    break;
                }

                default: {

                    header("Location: /admin/admob");
                    exit;
                }
            }
        }

    }

    $page_id = "admob";

    helper::newAuthenticityToken();

    $css_files = array("mytheme.css");
    $page_title = "AdMob Settings | Admin Panel";

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
                            <li class="breadcrumb-item active">Настройки Admob</li>
                        </ol>
                    </div>
                </div>

                <?php

                    include_once("../html/common/admin_banner.inc.php");
                ?>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card text-center">
                            <div class="card-body">
                                <h4 class="card-title">Внимание!</h4>
                                <p class="card-text">Изменения в приложении вступят в силу при следующей авторизации пользователя</p>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Информация</h4>
                                <h6 class="card-subtitle">
                                    <?php

                                        if ($default == 1) {

                                            ?>

                                            <a href="/admin/admob/?access_token=<?php echo admin::getAccessToken(); ?>&act=global_off">
                                                <button class="btn waves-effect waves-light btn-info">Выключить рекламу Admob для новых пользователей</button>
                                            </a>

                                            <?php

                                        } else {

                                            ?>
                                            <a href="/admin/admob/?access_token=<?php echo admin::getAccessToken(); ?>&act=global_on">
                                                <button class="btn waves-effect waves-light btn-info">Включить рекламу Admob для новых пользователей</button>
                                            </a>
                                            <?php

                                        }

                                    ?>

                                    <a href="/admin/admob/?access_token=<?php echo admin::getAccessToken(); ?>&act=on">
                                        <button class="btn waves-effect waves-light btn-info">Включить рекламу Admob во всех аккаунтах</button>
                                    </a>
                                    <a href="/admin/admob/?access_token=<?php echo admin::getAccessToken(); ?>&act=off">
                                        <button class="btn waves-effect waves-light btn-info">Выключить рекламу Admob во всех аккаунтах</button>
                                    </a>

                                </h6>
                                <div class="table-responsive">

                                    <table class="table color-table info-table">

                                    <thead>
                                        <tr>
                                            <th class="text-left">Тип</th>
                                            <th>Кол-во</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td class="text-left">AdMob активен в аккаунтах (On)</td>
                                            <td><?php echo $stats->getAccountsCountByAdmob(1); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">Количество аккаунтов с отключенной AdMob (Off)</td>
                                            <td><?php echo $stats->getAccountsCountByAdmob(0); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">Значение AdMob по умолчанию для новых пользователей</td>
                                            <td><?php if ($default == 1) {echo "On";} else {echo "Off"; } ?></td>
                                        </tr>
                                    </tbody>

                                </table>

                            </div>
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
