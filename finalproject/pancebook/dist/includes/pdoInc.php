<?php
$db_server = "localhost";
$db_user = "ocar";
$db_passwd = "d9!@/PnrOnVy-3sH";
$db_name = "finalproject";

try {
    $dsn = "mysql:host=$db_server;dbname=$db_name";
    $dbh = new PDO($dsn, $db_user, $db_passwd);
} catch (Exception $e) {
    die('無法對資料庫連線');
}

$dbh->exec("SET NAMES utf8");
