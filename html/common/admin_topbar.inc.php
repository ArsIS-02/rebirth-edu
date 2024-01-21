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

?>

<header class="topbar">
    <nav class="navbar top-navbar navbar-toggleable-sm navbar-light">
        <!-- ============================================================== -->
        <!-- Logo -->
        <!-- ============================================================== -->
        <div class="navbar-header">
            <a class="navbar-brand" href="/admin/main">
                <b> <!-- Logo icon --> <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                    <img src="/img/admin-logo-icon.png" alt="homepage" class="light-logo" /> <!-- Light Logo icon -->
                </b> <!--End Logo icon -->

                <span> <!-- Logo text --> <!-- Light Logo text -->
                    <img src="/img/admin-logo-text.png" class="light-logo" alt="homepage" />
                </span>
            </a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav mr-auto mt-md-0">
                <!-- This is  -->
                <li class="nav-item">
                    <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)">
                        <i class="mdi mdi-menu"></i>
                    </a>
                </li>

                <!-- ============================================================== -->
                <!-- Search -->
                <!-- ============================================================== -->
<!--                <li class="nav-item hidden-sm-down search-box">-->
<!--                    <a class="nav-link hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>-->
<!---->
<!--                    <form class="app-search">-->
<!--                        <input type="text" class="form-control" placeholder="Search & enter">-->
<!--                        <a class="srh-btn">-->
<!--                            <i class="ti-close"></i>-->
<!--                        </a>-->
<!--                    </form>-->
<!--                </li>-->

<!--                <li class="nav-item hidden-sm-down ">-->
<!--                    <a class="nav-link hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)" data-toggle="modal" data-target="#myModal"><i class="ti-search"></i></a>-->
<!--                </li>-->

            </ul>
            <!-- ============================================================== -->
            <!-- User profile and search -->
            <!-- ============================================================== -->
            <ul class="navbar-nav my-lg-0">

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Стрим
                    </a>
                    <div class="dropdown-menu dropdown-menu-right scale-up show">
                        <ul class="dropdown-user">
                            <li><a href="/admin/stream"><i class="ti-list"></i> Посты</a></li>
                            <li><a href="/admin/market_stream"><i class="ti-list"></i> Магазин</a></li>
                            <li><a href="/admin/messages_stream"><i class="ti-list"></i> Сообщения</a></li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Жалобы
                    </a>
                    <div class="dropdown-menu dropdown-menu-right scale-up show">
                        <ul class="dropdown-user">
                            <li><a href="/admin/profile_reports"><i class="ti-list"></i> Профили</a></li>
                            <li><a href="/admin/post_reports"><i class="ti-list"></i> Посты</a></li>
                            <li><a href="/admin/photo_reports"><i class="ti-list"></i> Изображения</a></li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item dropdown ">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <img src="/img/profile_default_photo.png" alt="user" class="profile-pic">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right scale-up show">
                        <ul class="dropdown-user">
                            <li><a href="/admin/support"><i class="ti-email"></i> ТехПоддержка</a></li>
                            <li><a href="/admin/settings"><i class="ti-settings"></i> Настройки</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="/admin/logout/?access_token=<?php echo admin::getAccessToken(); ?>&continue=/"><i class="fa fa-power-off"></i> Выход</a></li>
                        </ul>
                    </div>
                </li>

            </ul>
        </div>
    </nav>
</header>