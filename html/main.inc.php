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

    if (auth::isSession()) {

        header("Location: /account/wall");
    }

    $user_username = '';

    $error = false;
    $error_message = '';

    if (!empty($_POST)) {

        $user_username = isset($_POST['user_username']) ? $_POST['user_username'] : '';
        $user_password = isset($_POST['user_password']) ? $_POST['user_password'] : '';
        $token = isset($_POST['authenticity_token']) ? $_POST['authenticity_token'] : '';

        $user_username = helper::clearText($user_username);
        $user_password = helper::clearText($user_password);

        $user_username = helper::escapeText($user_username);
        $user_password = helper::escapeText($user_password);

        if (auth::getAuthenticityToken() !== $token) {

            $error = true;
        }

        if (!$error) {

            $access_data = array();

            $account = new account($dbo);

            $access_data = $account->signin($user_username, $user_password);

            unset($account);

            if (!$access_data['error']) {

                $account = new account($dbo, $access_data['accountId']);
                $accountInfo = $account->get();

                //print_r($accountInfo);

                switch ($accountInfo['state']) {

                    case ACCOUNT_STATE_BLOCKED: {

                        break;
                    }

                    default: {

                        $account->setState(ACCOUNT_STATE_ENABLED);

                        $clientId = 0; // Desktop version

                        $auth = new auth($dbo);
                        $access_data = $auth->create($accountInfo['id'], $clientId, APP_TYPE_WEB, "", $LANG['lang-code']);

                        if (!$access_data['error']) {

                            auth::setSession($access_data['accountId'], $accountInfo['username'], $accountInfo['fullname'], $accountInfo['lowPhotoUrl'], $accountInfo['verified'], $accountInfo['access_level'], $access_data['accessToken']);
                            auth::updateCookie($user_username, $access_data['accessToken']);

                            unset($_SESSION['oauth']);
                            unset($_SESSION['oauth_id']);
                            unset($_SESSION['oauth_name']);
                            unset($_SESSION['oauth_email']);
                            unset($_SESSION['oauth_link']);

                            $account->setLastActive();

                            header("Location: /");
                        }
                    }
                }

            } else {

                $error = true;
            }
        }
    }

    auth::newAuthenticityToken();

    $page_id = "main";

    $css_files = array("landing.css", "my.css");
    $page_title = APP_TITLE;

    include_once("../html/common/header.inc.php");

?>

<body class="home has-bottom-footer main-page">

    <?php

        include_once("../html/common/topbar.inc.php");
    ?>

    <div class="content-page">

        <div class="limiter">

            <?php

            if (WEB_EXPLORE) {

                ?>
                <div class="wrap-landing-info-container explore-promo">

                    <div class="wrap-landing-info">
                        <?php echo sprintf($LANG['main-page-promo-explore'], APP_TITLE); ?>
                        <a href="/explore" class="button green mt-4 p-3"><?php echo $LANG['action-explore']; ?> <i class="fa fa-arrow-right ml-1"></i></a>
                    </div>
                </div>
                <?php
            }
            ?>

            <div class="container-login100">
                <div class="wrap-login100">

                    <form accept-charset="UTF-8" action="/" class="custom-form login100-form" id="login-form" method="post">

                        <input autocomplete="off" type="hidden" name="authenticity_token" value="<?php echo helper::getAuthenticityToken(); ?>">

                        <span class="login100-form-title "><?php echo $LANG['page-login']; ?></span>

                        <?php

                        if (FACEBOOK_AUTHORIZATION) {

                            ?>

                            <p>
                                <a class="fb-icon-btn fb-btn-large btn-facebook" href="/facebook/login">
                                    <span class="icon-container">
                                        <i class="icon icon-facebook"></i>
                                    </span>
                                    <span><?php echo $LANG['action-login-with']." ".$LANG['label-facebook']; ?></span>
                                </a>
                            </p>
                            <?php
                        }
                        ?>

                        <div class="errors-container" style="<?php if (!$error) echo "display: none"; ?>">
                            <p class="title"><?php echo $LANG['label-errors-title']; ?></p>
                            <ul>
                                <li><?php echo $LANG['msg-error-authorize']; ?></li>
                            </ul>
                        </div>

                        <input id="username" name="user_username" placeholder="<?php echo $LANG['label-username']; ?>" required="required" size="30" type="text" value="<?php echo $user_username; ?>">
                        <input id="password" name="user_password" placeholder="<?php echo $LANG['label-password']; ?>" required="required" size="30" type="password" value="">

                        <div class="login-button">
                            <input style="margin-right: 10px" class="submit-button button blue" name="commit" type="submit" value="<?php echo $LANG['action-login']; ?>">
                            <a href="/remind" class="help"><?php echo $LANG['action-forgot-password']; ?></a>
                        </div>
                    </form>

                    <div class="login100-more">
                        <div class="login100_content">
                            <h1 class="mb-10"><?php echo APP_NAME; ?>!</h1>
                            <p><?php echo sprintf($LANG['main-page-promo-login'], APP_TITLE); ?></p>
                        </div>
                    </div>

                </div>

            </div>

            <?php

                if (strlen(GOOGLE_PLAY_LINK) != 0) {

                    ?>
                        <div class="wrap-landing-info-container">

                            <div class="wrap-landing-info">
                                <?php echo sprintf($LANG['main-page-promo-google-app'], APP_TITLE, APP_TITLE); ?>
                                <a href="<?php echo GOOGLE_PLAY_LINK; ?>" target="_blank" rel="nofollow">
                                    <img class="mt-4" width="170" src="/img/google_play.png">
                                </a>
                            </div>
                        </div>
                    <?php
                }
            ?>

            <?php

                include_once("../html/common/footer.inc.php");
            ?>

        </div>


    </div>



</body
</html>