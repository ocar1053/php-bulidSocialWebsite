<?php
session_start();
include('includes/pdoInc.php');
$pairid =  base64_decode($_GET["page"]);
$sth = $dbh->prepare(
    'SELECT * FROM (SELECT * from chat WHERE pairid = ? ORDER BY time DESC LIMIT 500) AS OAO ORDER BY time'
);
$sth->execute(array((int)$pairid));

$resultArr = array();
while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
    $resultArr[] = array(
        'nickname' => htmlspecialchars($row["nickname"]),
        'msg' => htmlspecialchars($row["msg"]),
        'time' => $row["time"],
    );
}
echo json_encode($resultArr);
