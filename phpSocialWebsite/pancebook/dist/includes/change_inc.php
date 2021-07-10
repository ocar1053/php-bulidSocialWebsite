<?php

if (isset($_POST['submit'])) {
    //connect to database
    include('pdoInc.php');

    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $ChangePassword = htmlspecialchars($_POST['changepassword']);
    $confirmPassword = htmlspecialchars($_POST['confirmchangepassword']);

    //errorhandleq
    if (empty($username) || empty($password) || empty($ChangePassword) || empty($confirmPassword)) {
        echo "<script type='text/javascript'>alert('empyt filed!');</script>";
        echo '
            <meta http-equiv=REFRESH CONTENT=0;url=../change.php>';
    } else if (!preg_match("/^[a-zA-Z0-9]*/", $username)) {
        echo "<script type='text/javascript'>alert('invalid username');</script>";
        echo '
            <meta http-equiv=REFRESH CONTENT=0;url=../change.php>';
    } else if ($password == $ChangePassword) {
        echo "<script type='text/javascript'>alert('change password error');</script>";
        echo '
            <meta http-equiv=REFRESH CONTENT=0;url=../change.php>';
    } else if ($ChangePassword != $confirmPassword) {
        echo "<script type='text/javascript'>alert('change password error');</script>";
        echo '
            <meta http-equiv=REFRESH CONTENT=0;url=../change.php>';
    } else {
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([$username]);
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $passHashCheck = password_verify($password, $row['password']);

            //first check whether password is correct
            if ($passHashCheck) {
                session_start();
                $sql = "SELECT * FROM users WHERE username = ? AND id = ?";
                $stmt = $dbh->prepare($sql);
                $stmt->execute([$username, $_SESSION['id']]);
                $postCount = $stmt->rowCount();
                if ($postCount > 0) {
                    $newhashedPassword = password_hash($ChangePassword, PASSWORD_BCRYPT);
                    $sql = 'UPDATE users SET username = ?, password = ? WHERE id = ?';
                    $stmt = $dbh->prepare($sql);
                    $stmt->execute([$username, $newhashedPassword, $_SESSION['id']]);
                    $_SESSION['username'] = $row['username'];
                    echo "<script type='text/javascript'>alert('success');</script>";
                    echo '
                        <meta http-equiv=REFRESH CONTENT=0;url=../login.php>';
                } else if ($postCount == 0) {
                    echo "<script type='text/javascript'>alert('no such user');</script>";
                    echo '
                        <meta http-equiv=REFRESH CONTENT=0;url=../change.php>';;
                } else {
                    echo "<script type='text/javascript'>alert('error password or username');</script>";
                    echo '
                        <meta http-equiv=REFRESH CONTENT=0;url=../change.php>';
                }
            }
        }
    }
}
