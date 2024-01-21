<?php

 /* Copyright 2020-2023 Arsentyev Igor(https://rebirth-edu.ru).
     * Файлы проекта для социальной сети Rebirth, проект в рамках выполнения дипломной работы студента.
     * Разработка является тестовой, сроки тестирования до 01/03/2024.
     * Данный проект может быть использован только после разрешения правообладателем.
     */

// If timezone is not installed on the server

if (!defined("APP_SIGNATURE")) {

    header("Location: /");
    exit;
}

if (!ini_get('date.timezone')) {

    date_default_timezone_set('Europe/London'); // Please set you timezone identifier, see here: http://php.net/manual/en/timezones.php
}

include_once("C:/xampp/htdocs/rebirth-edu.ru/sys/config/db.inc.php");
include_once("C:/xampp/htdocs/rebirth-edu.ru/sys/config/constants.inc.php");
include_once("C:/xampp/htdocs/rebirth-edu.ru/sys/config/payments.inc.php");
include_once("C:/xampp/htdocs/rebirth-edu.ru/sys/config/lang.inc.php");

foreach ($C as $name => $val) {

    define($name, $val);
}

foreach ($B as $name => $val) {

    define($name, $val);
}

$dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME;

if (EMOJI_SUPPORT) {

    $dbo = new PDO($dsn, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"));

} else {

    $dbo = new PDO($dsn, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
}

spl_autoload_register(function($class)
{
    $filename = "C:/xampp/htdocs/rebirth-edu.ru/sys/class/sys/class/class.".$class.".inc.php";

    if (file_exists($filename)) {

        include_once($filename);
    }
});

if(!isset($_SESSION)) {

    ini_set('session.cookie_domain', '.'.APP_HOST);
    session_set_cookie_params(0, '/', '.'.APP_HOST);
}

$helper = new helper($dbo);
$auth = new auth($dbo);
