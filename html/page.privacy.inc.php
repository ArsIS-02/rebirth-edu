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

    $page_id = "privacy";

    $css_files = array("main.css", "my.css");
    $page_title = $LANG['page-privacy']." | ".APP_TITLE;

    include_once("../html/common/header.inc.php");

    ?>

<body class="about has-bottom-footer">


    <?php
        include_once("../html/common/topbar.inc.php");
    ?>


    <div class="wrap content-page">

        <div class="main-column">

            <div class="main-content">

                <?php

                    if (file_exists("../html/privacy/".$LANG['lang-code'].".inc.php")) {

                        include_once("../html/privacy/".$LANG['lang-code'].".inc.php");

                    } else {

                        include_once("../html/privacy/en.inc.php");
                    }
                ?>

            </div>

        </div>

    </div>

    <?php

        include_once("../html/common/footer.inc.php");
    ?>


</body
</html>