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

    if (!admin::isSession()) {

        header("Location: /admin/login");
        exit;
    }

    $stats = new stats($dbo);
    $admin = new admin($dbo);

    if (isset($_GET['account_id'])) {

        $action = isset($_GET['act']) ? $_GET['act'] : '';

        $accountId = isset($_GET['account_id']) ? $_GET['account_id'] : 0;
        $accessToken = isset($_GET['access_token']) ? $_GET['access_token'] : '';

        $accountId = helper::clearInt($accountId);

        if ($accessToken === admin::getAccessToken() && !APP_DEMO) {

            $moderator = new moderator($dbo);

            switch ($action) {

                case "photo_approve": {

                    $moderator->approvePhoto($accountId);

                    break;
                }

                case "photo_reject": {

                    $moderator->rejectPhoto($accountId);

                    break;
                }

                case "cover_approve": {

                    $moderator->approveCover($accountId);

                    break;
                }

                case "cover_reject": {

                    $moderator->rejectCover($accountId);

                    break;
                }

                default: {

                    break;
                }
            }

            unset($moderator);
        }

    } else {

        header("Location: /admin/main");
        exit;
    }
