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

    $moderator = new moderator($dbo);

    $inbox_all = $moderator->getAllCount();
    $inbox_loaded = 0;

    if (!empty($_POST)) {

        $itemId = isset($_POST['itemId']) ? $_POST['itemId'] : 0;
        $loaded = isset($_POST['loaded']) ? $_POST['loaded'] : 0;

        $itemId = helper::clearInt($itemId);
        $loaded = helper::clearInt($loaded);

        $result = $moderator->getNotModeratedCovers($itemId);

        $inbox_loaded = count($result['items']);

        $result['inbox_loaded'] = $inbox_loaded + $loaded;
        $result['inbox_all'] = $inbox_all;

        if ($inbox_loaded != 0) {

            ob_start();

            foreach ($result['items'] as $key => $value) {

                draw($value);
            }

            $result['html'] = ob_get_clean();

            if ($result['inbox_loaded'] < $inbox_all) {

                ob_start();

                ?>

                    <a href="javascript:void(0)" onclick="Stream.moreItems('<?php echo $result['itemId']; ?>'); return false;">
                        <button type="button" class="btn  btn-info footable-show">Больше</button>
                    </a>

                <?php

                $result['html2'] = ob_get_clean();
            }
        }

        echo json_encode($result);
        exit;
    }

    $page_id = "profile_covers_moderation";

    $css_files = array("mytheme.css");
    $page_title = "Profile Covers Moderation | Admin Panel";

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
                            <li class="breadcrumb-item active">Модерация обложек профиля</li>
                        </ol>
                    </div>
                </div>

                <?php

                    include_once("../html/common/admin_banner.inc.php");
                ?>

                <?php

                    $result = $moderator->getNotModeratedCovers(0);

                    $inbox_loaded = count($result['items']);

                    if ($inbox_loaded != 0) {

                        ?>

                        <div class="row">
                            <div class="col-md-12">

                                <div class="card">
                                    <div class="card-body collapse show">
                                        <h4 class="card-title">Отклонить и одобрить?</h4>
                                        <p class="card-text">Отклонить - отправить пользователю сообщение с просьбой установить правильное изображение обложки. После того, как пользователь установил другое изображение обложки, обложка его профиля будет отображаться здесь снова для повторной модерации.</p>
                                        <p class="card-text">Одобрить - изображение обложки профиля пользователя будет «модерировано» и будет отображаться в профиле пользователя для всех пользователей.</p>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title m-b-0">Модерация обложек профиля</h4>
                                    </div>
                                    <div class="card-body collapse show">
                                        <div class="table-responsive">
                                            <table class="table product-overview">
                                                <thead>
                                                <tr>
                                                    <th colspan="2">Юзер</th>
                                                    <th>Фото</th>
                                                    <th>Дата Загрузки</th>
                                                    <th>Действие</th>
                                                </tr>
                                                </thead>
                                                <tbody class="data-table">
                                                    <?php

                                                        foreach ($result['items'] as $key => $value) {

                                                            draw($value);
                                                        }

                                                    ?>
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>

                                    <?php

                                        if ($inbox_loaded >= 20) {

                                            ?>

                                            <div class="card-body more-items loading-more-container">
                                                <a href="javascript:void(0)" onclick="Stream.moreItems('<?php echo $result['itemId']; ?>'); return false;">
                                                    <button type="button" class="btn  btn-info footable-show">Больше</button>
                                                </a>
                                            </div>

                                            <?php
                                        }
                                    ?>

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

        <script type="text/javascript">

            var inbox_all = <?php echo $inbox_all; ?>;
            var inbox_loaded = <?php echo $inbox_loaded; ?>;

            window.Stream || ( window.Stream = {} );

            Stream.reject = function (offset, accessToken, act) {

                $.ajax({
                    type: 'GET',
                    url: '/admin/moderation_actions?account_id=' + offset  + '&access_token=' + accessToken + "&act=" + act,
                    data: 'itemId=' + offset + "&access_token=" + accessToken,
                    timeout: 30000,
                    success: function(response) {

                        $('tr.data-item[data-id=' + offset + ']').remove();
                    },
                    error: function(xhr, type){

                    }
                });
            };

            Stream.approve = function (offset, accessToken, act) {

                $.ajax({
                    type: 'GET',
                    url: '/admin/moderation_actions?account_id=' + offset  + '&access_token=' + accessToken + "&act=" + act,
                    data: 'itemId=' + offset + "&access_token=" + accessToken,
                    timeout: 30000,
                    success: function(response) {

                        $('tr.data-item[data-id=' + offset + ']').remove();
                    },
                    error: function(xhr, type){

                    }
                });
            };

            Stream.moreItems = function (offset) {

                $('div.loading-more-container').hide();

                $.ajax({
                    type: 'POST',
                    url: '/admin/moderation_profile_covers',
                    data: 'itemId=' + offset + "&loaded=" + inbox_loaded,
                    dataType: 'json',
                    timeout: 30000,
                    success: function(response){

                        if (response.hasOwnProperty('html2')){

                            $("div.loading-more-container").html("").append(response.html2).show();
                        }

                        if (response.hasOwnProperty('html')){

                            $("tbody.data-table").append(response.html);
                        }

                        inbox_loaded = response.inbox_loaded;
                        inbox_all = response.inbox_all;
                    },
                    error: function(xhr, type){

                        $('div.loading-more-container').show();
                    }
                });
            };

        </script>

        </div> <!-- End Page wrapper  -->
    </div> <!-- End Wrapper -->

</body>

</html>

<?php

    function draw($item)
    {
        ?>

            <tr class="data-item" data-id="<?php echo $item['id']; ?>">

                <td style="width:50px;">

                    <?php

                        if (strlen($item['lowPhotoUrl']) != 0) {

                            ?>
                                <span class="round" style="background-size: cover; background-image: url(<?php echo $item['lowPhotoUrl']; ?>)"></span>
                            <?php

                        } else {

                            ?>
                                <span class="round" style="background-size: cover; background-image: url(/img/profile_default_photo.png)"></span>
                            <?php
                        }
                    ?>
                </td>
                <td>
                    <h6><a href="/admin/profile?id=<?php echo $item['id']; ?>"><?php echo $item['fullname']; ?></a></h6>
                    <small class="text-muted">@<?php echo $item['username']; ?></small>
                </td>
                <td>
                    <?php

                    if (strlen($item['normalCoverUrl']) != 0) {

                        ?>
                        <img src="<?php echo $item['normalCoverUrl']; ?>" alt="photo" width="180">
                        <?php

                    } else {

                        ?>
                        Нет Изображения!
                        <?php
                    }
                    ?>
                </td>
                <td>
                    <h6><?php echo date("Y-m-d H:i:s", $item['coverPostModerateAt']); ?></h6>
                </td>
                <td>
                    <a href="javascript:void(0)" onclick="Stream.reject('<?php echo $item['id']; ?>', '<?php echo admin::getAccessToken(); ?>', 'cover_reject'); return false;" class="text-inverse" title="" data-toggle="tooltip" data-original-title="Reject"><i class="ti-trash"></i> Отклонить</a>
                    <span> | </span>
                    <a href="javascript:void(0)" onclick="Stream.approve('<?php echo $item['id']; ?>', '<?php echo admin::getAccessToken(); ?>', 'cover_approve'); return false;" class="text-inverse" title="" data-toggle="tooltip" data-original-title="Approve"><i class="ti-check"></i> Одобрить</a>
                </td>
            </tr>

        <?php
    }