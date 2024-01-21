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

    $page_id = "error";

    $css_files = array("main.css", "my.css");
    $page_title = $LANG['page-error-404']." | ".APP_TITLE;

    include_once("../html/common/header.inc.php");

?>

<body class="remind-page has-bottom-footer">

    <?php

        include_once("../html/common/topbar.inc.php");
    ?>

    <div class="wrap content-page">

        <div class="main-column">

            <div class="main-content">

                <header class="top-banner">

                    <div class="info">
                        <h1><?php echo $LANG['label-error-404']; ?></h1>
                    </div>

                    <div class="prompt">
                        <a href="/" class="post-job-button button green">
                            <?php echo $LANG['action-back-to-main-page']; ?>
                        </a>
                    </div>

                </header>

            </div>
        </div>

    </div>

    <?php

    include_once("../html/common/footer.inc.php");
    ?>


</body
</html>