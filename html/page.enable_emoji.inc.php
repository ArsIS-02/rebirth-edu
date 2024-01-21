<?php

    /* Copyright 2020-2023 Arsentyev Igor(https://rebirth-edu.ru).
     * Файлы проекта для социальной сети Rebirth, проект в рамках выполнения дипломной работы студента.
     * Разработка является тестовой, сроки тестирования до 01/03/2024.
     * Данный проект может быть использован только после разрешения правообладателем.
     */

    if (!defined("APP_SIGNATURE")) {

        header("Location: /");
        exit;
    }

    $page_id = "emoji";

    include_once("../sys/core/initialize.inc.php");

    $update = new update($dbo);
    $update->setChatEmojiSupport();
    $update->setCommentsEmojiSupport();
    $update->setPostsEmojiSupport();

    $update->setGiftsEmojiSupport();

    $update->setDialogsEmojiSupport();

    $update->setGalleryEmojiSupport();
    $update->setGalleryCommentsEmojiSupport();

    $css_files = array("main.css", "my.css");
    $page_title = APP_TITLE;

    include_once("../html/common/header.inc.php");
?>

<body class="remind-page">

    <?php

        include_once("../html/common/topbar.inc.php");
    ?>

    <div class="wrap content-page">
        <div class="main-column">
            <div class="main-content">

                <div class="standard-page">

                    <div class="success-container" style="margin-top: 15px;">
                        <ul>
                            <b>Success!</b>
                            <br>
                            Your MySQL version:
                            <?php

                            if (function_exists('mysql_get_client_info')) {

                                print mysql_get_client_info();

                            } else {

                                echo $dbo->query('select version()')->fetchColumn();
                            }
                            ?>
                            <br>
                            Database refactoring success!
                        </ul>
                    </div>

                </div>

            </div>
        </div>

    </div>

    <?php

        include_once("../html/common/footer.inc.php");
    ?>

</body>
</html>