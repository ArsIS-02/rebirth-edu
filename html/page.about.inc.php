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

    $page_id = "about";

    $css_files = array("main.css", "my.css");
    $page_title = $LANG['page-about'];

    include_once("../html/common/header.inc.php");

    ?>

<body class="about has-bottom-footer">


    <?php
        include_once("../html/common/topbar.inc.php");
    ?>


    <div class="wrap content-page">

        <div class="main-column">

            <div class="main-content">

                <section class="standard-page">
                    <h1><?php echo $LANG['page-about']; ?></h1>
                    <p><?php echo APP_TITLE." ".APP_VERSION." (web version) © ".APP_YEAR; ?></p>
                </section>

                <section class="standard-page">
                    <h1>Проект Социальной Сети</h1>

                    <h3>Что это такое</h3>

                    <p>Социальная Сеть "Rebirth Network" представляет собой платформу для общения людей по интересам. Данный проект является результатом дипломной работы студента УрФУ им.Б.Н.Ельцина ИРИТ-РТФ. Мы будем рады протестировать данный сервис.На просторах данной социальной сети вы можете найти единомышленников по интересам. Только не стоит здесь обсуждать политическую ситуацию в мире - здесь не место для политических диспутов.Все посты, связанные с тематикой политики, а также межнациональной вражды будут удаляться модератором.</p>

                </section>

            </div>

        </div>

    </div>

    <?php

        include_once("../html/common/footer.inc.php");
    ?>


</body
</html>