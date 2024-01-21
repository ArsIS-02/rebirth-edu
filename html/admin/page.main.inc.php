<?php

   

    if (!defined("APP_SIGNATURE")) {

        header("Location: /");
        exit;
    }

    if (!admin::isSession()) {

        header("Location: /admin/login");
        exit;
    }

    $stats = new stats($dbo);
    $admin = new admin($dbo);

    $page_id = "main";

    $css_files = array("mytheme.css");
    $page_title = "Панель";

    include_once("../html/common/admin_header.inc.php");
?>

<body class="fix-header fix-sidebar card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">

        <?php

            include_once("../html/common/admin_topbar.inc.php");
        ?>

        <?php

            include_once("../html/common/admin_sidebar.inc.php");
        ?>

        <div class="page-wrapper"> <!-- Page wrapper  -->

            <div class="container-fluid"> <!-- Container fluid  -->

                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor">Панель</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Главная</a></li>
                            <li class="breadcrumb-item active">Панель</li>
                        </ol>
                    </div>
                </div>

                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round round-lg align-self-center round-info">
                                        <i class="ti-user"></i>
                                    </div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0 font-light"><?php echo $stats->getUsersCount(); ?></h3>
                                        <h5 class="text-muted m-b-0">Всего Пользователей</h5></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round round-lg align-self-center round-warning">
                                        <i class="ti-comment-alt"></i>
                                    </div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0 font-lgiht"><?php echo $stats->getCommentsTotal(); ?></h3>
                                        <h5 class="text-muted m-b-0">Всего Комментарий</h5></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round round-lg align-self-center round-primary"><i class="ti-comments"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0 font-lgiht"><?php echo $stats->getMessagesTotal(); ?></h3>
                                        <h5 class="text-muted m-b-0">Всего сообщений</h5></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round round-lg align-self-center round-danger"><i class="ti-layout-list-post"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0 font-lgiht"><?php echo $stats->getItemsTotal(); ?></h3>
                                        <h5 class="text-muted m-b-0">Всего Постов</h5></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title m-b-0">Полная статистика</h4>
                            </div>
                            <div class="card-body collapse show">
                                <div class="table-responsive">
                                    <table class="table product-overview">
                                        <thead>
                                        <tr>
                                            <th class="text-left">Название</th>
                                            <th>Количество</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="text-left">Аккаунты</td>
                                            <td><?php echo $stats->getUsersCount(); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">Активные аккаунты</td>
                                            <td><?php echo $stats->getUsersCountByState(ACCOUNT_STATE_ENABLED); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">Заблокированные аккаунты</td>
                                            <td><?php echo $stats->getUsersCountByState(ACCOUNT_STATE_BLOCKED); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">Группы</td>
                                            <td><?php echo $stats->getGroupsCount(); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">Деактивированные группы</td>
                                            <td><?php echo $stats->getGroupsCountByState(ACCOUNT_STATE_DISABLED); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">Заблокированные группы</td>
                                            <td><?php echo $stats->getGroupsCountByState(ACCOUNT_STATE_BLOCKED); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">Всего комментарий</td>
                                            <td><?php echo $stats->getCommentsTotal(); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">Всего активных комментариев (не удаленых)</td>
                                            <td><?php echo $stats->getCommentsCount(); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">Всего лайков</td>
                                            <td><?php echo $stats->getLikesTotal(); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">Всего активных лайков (не удаленых)</td>
                                            <td><?php echo $stats->getLikesCount(); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">Всего фото</td>
                                            <td><?php echo $stats->getPhotosCount(); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">Всего активных фото (не удаленых)</td>
                                            <td><?php echo $stats->getActivePhotosCount(); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">Всего постов</td>
                                            <td><?php echo $stats->getItemsTotal(); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">Всего активных постов (не удаленых)</td>
                                            <td><?php echo $stats->getItemsCount(); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">Всего подарков</td>
                                            <td><?php echo $stats->getGiftsCount(); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">Всего активных подарков (не удаленых)</td>
                                            <td><?php echo $stats->getActiveGiftsCount(); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">Всего чатов</td>
                                            <td><?php echo $stats->getChatsTotal(); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">Всего активных чатов (не удаленых)</td>
                                            <td><?php echo $stats->getChatsCount(); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">Всего сообщений</td>
                                            <td><?php echo $stats->getMessagesTotal(); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">Всего активных сообщений (не удаленых)</td>
                                            <td><?php echo $stats->getMessagesCount(); ?></td>
                                        </tr>
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php

                    $result = $stats->getAccounts(0);

                    $inbox_loaded = count($result['users']);

                    if ($inbox_loaded != 0) {

                        ?>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex no-block">
                                            <h4 class="card-title">Недавно зарегистрированные пользователи</h4>
                                        </div>
                                        <div class="table-responsive m-t-20">
                                            <table class="table stylish-table">
                                                <thead>
                                                <tr>
                                                    <th colspan="2">Пользователь</th>
                                                    <th>Статус</th>
                                                    <th>Facebook</th>
                                                    <th>Email</th>
                                                    <th>Дата регистрации</th>
                                                    <th>IP адрес</th>
                                                    <th>Действие</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                <?php

                                                    foreach ($result['users'] as $key => $value) {

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

                    }
                ?>


            </div> <!-- End Container fluid  -->

            <?php

                include_once("../html/common/admin_footer.inc.php");
            ?>

        </div> <!-- End Page wrapper  -->

    </div> <!-- End Main Wrapper -->

</body>

</html>

<?php

    function draw($user)
    {
        ?>

            <tr>
                <td style="width:50px;">

                    <?php

                        if (strlen($user['lowPhotoUrl']) != 0) {

                            ?>
                                <span class="round" style="background-size: cover; background-image: url(<?php echo $user['lowPhotoUrl']; ?>)"></span>
                            <?php

                        } else {

                            ?>
                                <span class="round" style="background-size: cover; background-image: url(/img/profile_default_photo.png)"></span>
                            <?php
                        }
                    ?>
                </td>
                <td>
                    <h6><a href="/admin/profile?id=<?php echo $user['id']; ?>"><?php echo $user['fullname']; ?></a></h6>
                    <small class="text-muted">@<?php echo $user['username']; ?></small>
                </td>
                <td>
                    <h6><?php if ($user['state'] == 0) {echo "Enabled";} else {echo "Blocked";} ?></h6>
                </td>
                <td>
                    <h6><?php if (strlen($user['fb_id']) < 2) {echo "Не подключен к facebook.";} else {echo "<a target=\"_blank\" href=\"https://www.facebook.com/app_scoped_user_id/{$user['fb_id']}\">Facebook account link</a>";} ?></h6>
                </td>
                <td>
                    <h6><?php echo $user['email']; ?></h6>
                </td>
                <td><?php echo date("Y-m-d H:i:s", $user['regtime']); ?></td>
                <td><?php if (!APP_DEMO) {echo $user['ip_addr'];} else {echo "It is not available in the demo version";} ?></td>
                <td><a href="/admin/profile/?id=<?php echo $user['id']; ?>">Перейти в аккаунт</a></td>
            </tr>

        <?php
    }