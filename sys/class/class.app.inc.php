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

class app extends db_connect
{
    public function __construct($dbo = NULL)
    {
        parent::__construct($dbo);

    }

    public function getUsersPreview($limit = 6)
    {
        $result = array("error" => false,
                        "error_code" => ERROR_SUCCESS,
                        "items" => array());

        $stmt = $this->db->prepare("SELECT id, regtime FROM users WHERE state = 0 AND account_type = 0 AND lowPhotoUrl <> '' ORDER BY regtime DESC LIMIT :lmt");
        $stmt->bindParam(":lmt", $limit, PDO::PARAM_INT);

        if ($stmt->execute()) {

            if ($stmt->rowCount() > 0) {

                while ($row = $stmt->fetch()) {

                    $profile = new profile($this->db, $row['id']);
                    $profile->setRequestFrom($row['id']);

                    array_push($result['items'], $profile->getVeryShort());

                    unset($profile);
                }
            }
        }

        return $result;
    }
}
