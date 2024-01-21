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

    $accountId = isset($_POST['accountId']) ? $_POST['accountId'] : '';
    $accessToken = isset($_POST['accessToken']) ? $_POST['accessToken'] : '';

    $commentId = isset($_POST['commentId']) ? $_POST['commentId'] : 0;
    $itemType = isset($_POST['itemType']) ? $_POST['itemType'] : 0;

    $accountId = helper::clearInt($accountId);

    $commentId = helper::clearInt($commentId);
    $itemType = helper::clearInt($itemType);

    $result = array(
        "error" => true,
        "error_code" => ERROR_UNKNOWN
    );

    $auth = new auth($dbo);

    if (!$auth->authorize($accountId, $accessToken)) {

        api::printError(ERROR_ACCESS_TOKEN, "Error authorization.");
    }

    $comments = new comments($dbo, $itemType);
    $comments->setRequestFrom($accountId);

    $commentInfo = $comments->info($commentId);

    if ($commentInfo['fromUserId'] == $accountId || $commentInfo['itemFromUserId'] == $accountId) {

        $comments->remove($commentId);
    }

    unset($comments);

    echo json_encode($result);
    exit;
}
