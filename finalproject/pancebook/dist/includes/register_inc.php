<?php



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
        echo "<script type='text/javascript'>alert('malicious!');</script>";
        header("Location:..//register.php?acessforbidden");
    }
    if ($birth >= date("Y-m-d")) {
        echo "<script type='text/javascript'>alert('malicious!');</script>";
        header("Location:..//register.php?acessforbidden");
    }
    //errorhandle 
    if (empty($username) || empty($password) || empty($confirmPassword) || empty($birth) || empty($age) || empty($realName)) {
        echo "<script type='text/javascript'>alert('empyt filed!');</script>";
        echo '
            <meta http-equiv=REFRESH CONTENT=0;url=../register.php>';
    } else if (!preg_match("/^[a-zA-Z0-9]*/", $username)) {
        echo "<script type='text/javascript'>alert('invalid username!');</script>";
        echo '
            <meta http-equiv=REFRESH CONTENT=0;url=../register.php>';
    } else if ($password != $confirmPassword) {
        echo "<script type='text/javascript'>alert('error confirm password!');</script>";
        echo '
            <meta http-equiv=REFRESH CONTENT=0;url=../register.php>';
    } else {
        $sql = "SELECT username FROM users WHERE username = ?";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([$username]);
        $postCount = $stmt->rowCount();

        // check if username repeated
        if ($postCount > 0) {
            echo "<script type='text/javascript'>alert('repeated username!');</script>";
            echo '
                <meta http-equiv=REFRESH CONTENT=0;url=../register.php>';
        } else {
            //I prefer hash password by BCRYRT
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $sql = "INSERT INTO users (username, password, realName, birth, age) VALUES(?, ?, ?, ?,?)";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([$username, $hashedPassword, $realName, $birth, $age]);
            echo "<script type='text/javascript'>alert('success!');</script>";
            echo '
                <meta http-equiv=REFRESH CONTENT=0;url=../login.php>';
        }
    }
}
