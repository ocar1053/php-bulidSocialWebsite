<?php
$db_server = "localhost";
$db_user = "your user";
$db_passwd = "your password";
$db_name = "id16525717_forum";

try {
    $dsn = "mysql:host=$db_server;dbname=$db_name";
    $dbh = new PDO($dsn, $db_user, $db_passwd);
} catch (Exception $e) {
    die('無法對資料庫連線');
}

$dbh->exec("SET NAMES utf8");
