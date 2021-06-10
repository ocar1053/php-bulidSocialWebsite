<?php

if (isset($_POST['submit'])) {
    //connect to database
    include('pdoInc.php');

    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    //errorhandle 
    if (empty($username) || empty($password)) {
        echo "<script type='text/javascript'>alert('empyt filed!');</script>";
        echo '
            <meta http-equiv=REFRESH CONTENT=0;url=../login.php>';
    } else {
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([$username]);
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $passHashCheck = password_verify($password, $row['password']);
            if ($passHashCheck == false) {
                echo "<script type='text/javascript'>alert('error password!');</script>";
                echo '
                    <meta http-equiv=REFRESH CONTENT=0;url=../login.php>';
            } elseif ($passHashCheck == true) {
                session_start();
                $_SESSION['id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['adminControl'] = $row['adminControl'];
                header("Location:..//profile.php?" . "&id=" . $row['id']);
            } else {
                echo "<script type='text/javascript'>alert('error password!');</script>";
                echo '
                    <meta http-equiv=REFRESH CONTENT=0;url=../login.php>';
            }
        } else {
            echo "<script type='text/javascript'>alert('error username!');</script>";
            echo '
                <meta http-equiv=REFRESH CONTENT=0;url=../login.php>';
        }
    }
} else {
    header("Location:..//index.php?acessforbidden");
    exit();
}
