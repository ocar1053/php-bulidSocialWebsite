<?php
session_start();
include('pdoInc.php');



if (isset($_POST['submit']) &&  $_SESSION['id'] == $_GET['id'] && isset($_FILES['file']) && $_FILES["file"]["name"] != NULL) {
    $blackList = array('jpg', 'png', 'jpeg');
    $newDir =   "./uploads/";
    $newDir = str_replace("'", "", $newDir);
    $extension =  htmlspecialchars(@strtolower(end(explode('.', $_FILES["file"]["name"])))); // get extension
    $newFileName = uniqid('', true) . "." . $extension; // get time to name file
    $newFilePath = $newDir .  $newFileName; // final path
    if (in_array($extension, $blackList) && $_FILES["file"]["size"] <= 1024 * 1024) {

        move_uploaded_file($_FILES["file"]["tmp_name"], $newFilePath);
    } else {
        echo "<script type='text/javascript'>alert('不合法的檔案');</script>";
        echo '<meta http-equiv=REFRESH CONTENT=0;url=../profile.php?id=' . (int)$_GET['id'] . '>';
    }
    $stmt = $dbh->prepare('SELECT * FROM users WHERE id = ?'); //query for "board"
    $stmt->execute(array((int)$_GET['id']));
    if ($stmt->rowCount() == 1) {
        $stmt = $dbh->prepare(
            'UPDATE users SET image = ? WHERE id = ?'
        );
        $stmt->execute(array(
            $newFileName,
            $_GET['id'],
        ));
        echo "<script type='text/javascript'>alert('sucess');</script>";
        echo '<meta http-equiv=REFRESH CONTENT=0;url=../profile.php?id=' . (int)$_GET['id'] . '>';
    } else {
        echo "<script type='text/javascript'>alert('nouser');</script>";
        echo '<meta http-equiv=REFRESH CONTENT=0;url=../profile.php?id=' . (int)$_GET['id'] . '>';
    }
} else {
    echo "<script type='text/javascript'>alert('error');</script>";
    echo '<meta http-equiv=REFRESH CONTENT=0;url=../profile.php?id=' . (int)$_GET['id'] . '>';
}
