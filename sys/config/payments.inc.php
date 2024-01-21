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

// amount must be in cents | $1 = 100 cents

$payments_packages = array();

$payments_packages[] = array(
    "id" => 0,
    "amount" => 100,
    "credits" => 30,
    "name" => "30 credits");

$payments_packages[] = array(
    "id" => 1,
    "amount" => 200,
    "credits" => 70,
    "name" => "70 credits");

$payments_packages[] = array(
    "id" => 2,
    "amount" => 300,
    "credits" => 120,
    "name" => "120 credits");