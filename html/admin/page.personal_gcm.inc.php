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

    if (isset($_GET['id'])) {

        $accountId = isset($_GET['id']) ? $_GET['id'] : 0;

        $accountId = helper::clearInt($accountId);

        $account = new account($dbo, $accountId);
        $accountInfo = $account->get();

        if ($accountInfo['error'] === true) {

            header("Location: /admin/main");
            exit;
        }

    } else {

        header("Location: /admin/main");
        exit;
    }

    if (!empty($_POST)) {

        $authToken = isset($_POST['authenticity_token']) ? $_POST['authenticity_token'] : '';
        $message = isset($_POST['message']) ? $_POST['message'] : '';
        $type = isset($_POST['type']) ? $_POST['type'] : 1;

        $message = helper::clearText($message);
        $message = helper::escapeText($message);

        $type = helper::clearInt($type);

        if ($authToken === helper::getAuthenticityToken() && !APP_DEMO) {

            if (strlen($message) != 0) {

                $gcm = new gcm($dbo, $accountId);
                $gcm->setData($type, $message, 0);
                $gcm->send();
            }
        }

        header("Location: /admin/personal_gcm/?id=".$accountId);
        exit;
    }

    $page_id = "personal_gcm";

    helper::newAuthenticityToken();

    $css_files = array("mytheme.css");
    $page_title = "Firebase Cloud Messages | Admin Panel";

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
                            <li class="breadcrumb-item active">Firebase Cloud Messages</li>
                        </ol>
                    </div>
                </div>

                <?php

                    include_once("../html/common/admin_banner.inc.php");
                ?>

                <?php
                    if (APP_DEMO) {

                        ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <h4 class="card-title">Внимание!</h4>
                                            <p class="card-text">Отправка push-уведомлений (FCM) недоступна в режиме демонстрационной версии. Что мы отключили отправку push-уведомлений (FCM) в режиме демонстрационной версии, чтобы защитить пользователей от спама и нецензурной лексики.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                    }
                ?>


                <div class="row">

                    <div class="col-lg-12">

                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Отправить Уведомление</h4>

                                <form class="form-material m-t-40"  method="post" action="/admin/personal_gcm/?id=<?php echo $accountId; ?>">

                                    <input type="hidden" name="authenticity_token" value="<?php echo helper::getAuthenticityToken(); ?>">

                                    <div class="form-group">
                                        <label>Тип Сообщения</label>
                                        <select class="form-control" name="type">
                                            <option selected="selected" value="<?php echo GCM_NOTIFY_SYSTEM; ?>">Он будет отображаться, даже если пользователь не авторизован</option>
                                            <option value="<?php echo GCM_NOTIFY_PERSONAL; ?>">Только авторизованный пользователь</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label >Текс Сообщения</label>
                                        <input placeholder="Message text" id="message" type="text" name="message" maxlength="100" class="form-control form-control-line">
                                    </div>

                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <button class="btn btn-info text-uppercase waves-effect waves-light" type="submit">Отправить</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>

                    </div>


                </div>

                <?php
                    $result = $stats->getAccountGcmHistory($accountId);

                    $inbox_loaded = count($result['data']);

                    if ($inbox_loaded != 0) {

                        ?>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Недавно отправленные пользователю личные сообщения</h4>
                                        <div class="table-responsive">

                                            <table class="table color-table info-table">

                                                <thead>
                                                    <tr>
                                                        <th class="text-left">Id</th>
                                                        <th>Сообщение</th>
                                                        <th>Тип</th>
                                                        <th>Статус</th>
                                                        <th>Отправлено</th>
                                                        <th>Создано</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php

                                                        foreach ($result['data'] as $key => $value) {

                                                            draw($value);
                                                        }

                                                    ?>
                                                </tbody>

                                            </table>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php

                    } else {

                        ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <h4 class="card-title">Список пуст</h4>
                                            <p class="card-text">Это означает, что нет данных для отображения </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                    }
                ?>


            </div> <!-- End Container fluid  -->

            <?php

                include_once("../html/common/admin_footer.inc.php");
            ?>

        </div> <!-- End Page wrapper  -->
    </div> <!-- End Wrapper -->

</body>

</html>

<?php

    function draw($itemObj)
    {
        ?>

        <tr>
            <td class="text-left"><?php echo $itemObj['id']; ?></td>
            <td><?php echo $itemObj['msg']; ?></td>
            <td>
                <?php

                    switch ($itemObj['msgType']) {

                        case GCM_NOTIFY_SYSTEM: {

                            echo "It will be shown, even if not authorized";
                            break;
                        }

                        case GCM_NOTIFY_PERSONAL: {

                            echo "Only an authorized user";
                            break;
                        }

                        default: {

                            break;
                        }
                    }
                ?>
            </td>
            <td><?php if ($itemObj['status'] == 1) {echo "success";} else {echo "failure";} ?></td>
            <td><?php echo $itemObj['success']; ?></td>
            <td><?php echo date("Y-m-d H:i:s", $itemObj['createAt']); ?></td>
        </tr>

        <?php
    }
