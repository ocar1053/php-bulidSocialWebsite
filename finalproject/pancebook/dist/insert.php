<?php
session_start();
include('includes/pdoInc.php');

function getIp()
{
    return $_SERVER['REMOTE_ADDR'];
}
$pairid =  base64_decode($_POST["page"]); //解密



if (isset($_POST["nickname"]) && isset($_POST["msg"]) && $_POST["nickname"] != '' && $_POST["msg"] != '') {
    $sth = $dbh->prepare('INSERT INTO chat (nickname, msg, ip, pairid) VALUES (?, ?, ?, ?)');
    $sth->execute(array($_POST["nickname"], $_POST["msg"], getIp(), $pairid));
}
