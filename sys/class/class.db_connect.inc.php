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

class db_connect
{

    protected $db;

    protected function __construct($db = NULL)
    {

        if (is_object($db)) {

            $this->db = $db;

        }  else  {

            $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME;

            try  {

                if (EMOJI_SUPPORT) {

                    $this->db = new PDO($dsn, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"));

                } else {

                    $this->db = new PDO($dsn, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                }

            } catch (Exception $e) {

                die ($e->getMessage());
            }
        }
    }
}
