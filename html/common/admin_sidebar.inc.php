<?php


if (!defined("APP_SIGNATURE")) {

    header("Location: /");
    exit;
}

?>

<aside class="left-sidebar">

    <div class="scroll-sidebar"> <!-- Sidebar scroll-->

        <nav class="sidebar-nav"> <!-- Sidebar navigation-->

            <ul id="sidebarnav">

                <li class="nav-small-cap">Основное</li>

                <li>
                    <a class="waves-effect waves-dark <?php if (isset($page_id) && $page_id === "main") { echo "active";} ?>" href="/admin/main" aria-expanded="false">
                        <i class="ti-dashboard"></i>
                        <span class="hide-menu">Панель</span>
                    </a>
                </li>
                <li>
                    <a class="waves-effect waves-dark <?php if (isset($page_id) && $page_id === "gifts") { echo "active";} ?>" href="/admin/gifts" aria-expanded="false">
                        <i class="ti-gift"></i>
                        <span class="hide-menu">Подарки</span>
                    </a>
                </li>
                <li>
                    <a class="waves-effect waves-dark <?php if (isset($page_id) && $page_id === "adsense") { echo "active";} ?>" href="/admin/adsense" aria-expanded="false">
                        <i class="ti-layout-media-overlay"></i>
                        <span class="hide-menu">Adsense</span>
                    </a>
                </li>
                <li>
                    <a class="waves-effect waves-dark <?php if (isset($page_id) && $page_id === "admob") { echo "active";} ?>" href="/admin/admob" aria-expanded="false">
                        <i class="ti-layout-list-post"></i>
                        <span class="hide-menu">Admob</span>
                    </a>
                </li>
                <li>
                    <a class="waves-effect waves-dark <?php if (isset($page_id) && $page_id === "gcm") { echo "active";} ?>" href="/admin/gcm" aria-expanded="false">
                        <i class="ti-bell"></i>
                        <span class="hide-menu">Уведомления</span>
                    </a>
                </li>
                <li>
                    <a class="waves-effect waves-dark <?php if (isset($page_id) && $page_id === "users") { echo "active";} ?>" href="/admin/users" aria-expanded="false">
                        <i class=" ti-search"></i>
                        <span class="hide-menu">Юзеры и Группы</span>
                    </a>
                </li>

                <li class="nav-devider"></li>

                <li class="nav-small-cap">Модерация</li>

                <li>
                    <a class="waves-effect waves-dark <?php if (isset($page_id) && $page_id === "profile_photos_moderation") { echo "active";} ?>" href="/admin/moderation_profile_photos" aria-expanded="false">
                        <i class="ti-user"></i>
                        <span class="hide-menu">Аватары</span>
                    </a>
                </li>

                <li>
                    <a class="waves-effect waves-dark <?php if (isset($page_id) && $page_id === "profile_covers_moderation") { echo "active";} ?>" href="/admin/moderation_profile_covers" aria-expanded="false">
                        <i class="ti-image"></i>
                        <span class="hide-menu">Обложки</span>
                    </a>
                </li>

                <li class="nav-devider"></li>

                <li class="nav-small-cap">Настройки</li>

                <li>
                    <a class="waves-effect waves-dark <?php if (isset($page_id) && $page_id === "app") { echo "active";} ?>" href="/admin/app" aria-expanded="false">
                        <i class="ti-mobile"></i>
                        <span class="hide-menu">Приложение</span>
                    </a>
                </li>

                <li>
                    <a class="waves-effect waves-dark <?php if (isset($page_id) && $page_id === "support") { echo "active";} ?>" href="/admin/support" aria-expanded="false">
                        <i class="ti-help-alt"></i>
                        <span class="hide-menu">ТехПоддежка</span>
                    </a>
                </li>

                <li>
                    <a class="waves-effect waves-dark <?php if (isset($page_id) && $page_id === "settings") { echo "active";} ?>" href="/admin/settings" aria-expanded="false">
                        <i class="ti-settings"></i>
                        <span class="hide-menu">Настройки</span>
                    </a>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="/admin/logout/?access_token=<?php echo admin::getAccessToken(); ?>&continue=/" aria-expanded="false">
                        <i class="ti-power-off"></i>
                        <span class="hide-menu">Выход</span>
                    </a>
                </li>
            </ul>
        </nav> <!-- End Sidebar navigation -->
    </div> <!-- End Sidebar scroll-->
</aside>