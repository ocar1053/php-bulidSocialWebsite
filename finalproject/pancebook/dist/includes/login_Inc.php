<?php

if (isset($_POST['submit'])) {
    //connect to database
    include('pdoInc.php');

    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    //errorhandle 
    if (empty($username) || empty($password)) {
        header("Location:..//login.php?error=emptyfield");
        exit();
    } else {
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([$username]);
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $passHashCheck = password_verify($password, $row['password']);
            if ($passHashCheck == false) {
                header("Location:..//login.php?error=errorpassword");
                exit();
            } elseif ($passHashCheck == true) {
                session_start();
                $_SESSION['id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['adminControl'] = $row['adminControl'];
                header("Location:..//profile.php?" . "&id=" . $row['id']);
            } else {
                header("Location:..//login.php?error=errorpassword");
                exit();
            }
        } else {
            header("Location:..//login.php?error=errorusername");
            exit();
        }
    }
} else {
    header("Location:..//index.php?acessforbidden");
    exit();
}
