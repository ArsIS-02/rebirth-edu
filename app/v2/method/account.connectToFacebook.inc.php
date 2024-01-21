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

if (!empty($_POST)) {

    $clientId = isset($_POST['clientId']) ? $_POST['clientId'] : 0;

    $accountId = isset($_POST['accountId']) ? $_POST['accountId'] : '';
    $accessToken = isset($_POST['accessToken']) ? $_POST['accessToken'] : '';

    $facebookId = isset($_POST['facebookId']) ? $_POST['facebookId'] : '';

    $facebookId = helper::clearText($facebookId);
    $facebookId = helper::escapeText($facebookId);

    $clientId = helper::clearInt($clientId);
    $accountId = helper::clearInt($accountId);

    $accessToken = helper::clearText($accessToken);
    $accessToken = helper::escapeText($accessToken);

    if ($clientId != CLIENT_ID) {

        api::printError(ERROR_UNKNOWN, "Error client Id.");
    }

    $result = array("error" => true);

    $auth = new auth($dbo);

    if (!$auth->authorize($accountId, $accessToken)) {

        api::printError(ERROR_ACCESS_TOKEN, "Error authorization.");
    }

    $profileId = $helper->getUserIdByFacebook($facebookId);

    if ($profileId == 0) {

        $account = new account($dbo, $accountId);
        $account->setFacebookId($facebookId);

        $result = array("error" => false,
                        "error_code" => ERROR_SUCCESS);

    } else {

        $result = array("error" => false,
                        "error_code" => ERROR_FACEBOOK_ID_TAKEN);
    }

    echo json_encode($result);
    exit;
}
