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

    $profileId = isset($_POST['profileId']) ? $_POST['profileId'] : '';

    $chatId = isset($_POST['chatId']) ? $_POST['chatId'] : 0;

    $clientId = helper::clearInt($clientId);
    $accountId = helper::clearInt($accountId);

    $profileId = helper::clearInt($profileId);

    $chatId = helper::clearInt($chatId);

    $result = array("error" => true,
                    "error_code" => ERROR_UNKNOWN);

    $auth = new auth($dbo);

    if (!$auth->authorize($accountId, $accessToken)) {

        api::printError(ERROR_ACCESS_TOKEN, "Error authorization.");
    }

    $messages = new messages($dbo);
    $messages->setRequestFrom($accountId);

    $verifyId = $messages->getChatId($accountId, $profileId);

    if ($chatId == $verifyId) {

        $result = $messages->removeChat($chatId);
    }

    echo json_encode($result);
    exit;
}
