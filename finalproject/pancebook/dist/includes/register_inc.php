<?php

use function PHPSTORM_META\type;

if (isset($_POST['submit'])) {
    //connect to database
    include('pdoInc.php');
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $confirmPassword = htmlspecialchars($_POST['confirmPassword']);
    $birth = htmlspecialchars($_POST['birthday']);
    $age = htmlspecialchars($_POST['age']);
    $realName = htmlspecialchars($_POST['realName']);
    if (strlen($realName) >= 22 || strlen($username) >= 22 || !is_numeric($age) || (int)$age >= 150 || (int)$age <= 0) {
        header("Location:..//register.php?error=malicious" . $username);
        exit();
    }
    if ($birth >= date("Y-m-d")) {
        header("Location:..//register.php?error=malicious" . $username);
        exit();
    }
    //errorhandle 
    if (empty($username) || empty($password) || empty($confirmPassword) || empty($birth) || empty($age) || empty($realName)) {
        header("Location:..//register.php?error=emptyfield&&username=" . $username);
        exit();
    } else if (!preg_match("/^[a-zA-Z0-9]*/", $username)) {
        header("Location:..//register.php?error=invalidusername&&username=" . $username);
        exit();
    } else if ($password != $confirmPassword) {
        header("Location:..//register.php?error=errorcheckpassword&&username=" . $username);
        exit();
    } else {
        $sql = "SELECT username FROM users WHERE username = ?";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([$username]);
        $postCount = $stmt->rowCount();

        // check if username repeated
        if ($postCount > 0) {
            header("Location:..//register.php?error=repeatedusername&&username=" . $username);
            exit();
        } else {
            //I prefer hash password by BCRYRT
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $sql = "INSERT INTO users (username, password, realName, birth, age) VALUES(?, ?, ?, ?,?)";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([$username, $hashedPassword, $realName, $birth, $age]);
            header("Location:..//register.php?Success&&username=" . $username);
            exit();
        }
    }
}
