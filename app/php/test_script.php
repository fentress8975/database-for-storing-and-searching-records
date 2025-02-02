<?php

use test_task\JsonToBDLoader;

require_once "php/JsonToBDLoader.php";

$host     = 'mysql';
$dbname   = 'test';
$user     = 'root';
$password = 'root';
$port     = 3306;
$charset  = 'utf8mb4';

$postsURL = "https://jsonplaceholder.typicode.com/posts";
$commentsURL = 'https://jsonplaceholder.typicode.com/comments';


$db;

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
    $db = new mysqli($host, $user, $password, $dbname, $port);
    $db->set_charset($charset);
    $db->options(MYSQLI_OPT_INT_AND_FLOAT_NATIVE, 1);
} catch (\Throwable $th) {
    echo "Ошибка подключения к БД: \n";
    echo $th->getMessage();
    die();
}

$jsonToBDLoader = new JsonToBDLoader($db);

$jsonToBDLoader->uploadToDB($postsURL);
$jsonToBDLoader->uploadToDB($commentsURL);
