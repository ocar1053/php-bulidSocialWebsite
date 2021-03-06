<?php
session_start();
if (!isset($_SESSION['id'])) header("Location:login.php");
include('includes/pdoInc.php');
//Check if user exist
$sth = $dbh->prepare('SELECT * FROM users WHERE id = ?');
$sth->execute(array((int)$_GET['id']));
$rowCount = $sth->rowCount();
if ($rowCount != 1) {
    echo "<script type='text/javascript'>alert('不存在的使用者，因此為您傳送到管理員頁面');</script>";
    echo '
     <meta http-equiv=REFRESH CONTENT=0;url=profile.php?id=20>';
}

// edit personalile
if (isset($_POST['updatepersonalfile'])) {
    $birth = htmlspecialchars($_POST['updatebirth']);
    $realName = htmlspecialchars($_POST['updateage']);
    $age = htmlspecialchars($_POST['updatebirth']);
    if ($birth >= date("Y-m-d")) {
        if (strlen($realName) >= 22  || !is_numeric($age) || (int)$age >= 150 || (int)$age <= 0) {
            header('Location:..//profile.php?id=' . $_GET["id"] . '');
            exit();
        }
    }
    $age = htmlspecialchars($_POST['updateage']);
    $realName = htmlspecialchars($_POST['udpaterealname']);
    if (strlen($realName) >= 22  || !is_numeric($age) || (int)$age >= 150 || (int)$age <= 0) {
        header('Location:..//profile.php?id=' . $_GET["id"] . '');
        exit();
    }
    if (empty($birth) || empty($age) || empty($realName)) {

        header('Location:..//profile.php?id=' . $_GET["id"] . '');
        exit();
    }
    $sth = $dbh->prepare('SELECT * FROM users WHERE id = ?');
    $sth->execute(array((int)$_GET['id']));
    if ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
        //權限管控 
        if ($row['username'] == $_SESSION['username']) {
            $sql = 'UPDATE users SET birth  = ?, realName = ?, age = ?WHERE id = ?';
            $sth = $dbh->prepare($sql);
            $sth->execute(array($birth, $realName, $age,  (int)$_GET['id']));
            echo "<script type='text/javascript'>alert('編輯成功');</script>";
            echo '
            <meta http-equiv=REFRESH CONTENT=0;url=profile.php?id=' . (int)$_GET['id'] . '>';
        } else {
            echo "<script type='text/javascript'>alert('權限不足');</script>";
            echo '
            <meta http-equiv=REFRESH CONTENT=0;url=profile.php?id=' . (int)$_GET['id'] . '>';
        }
    } else {
        echo "<script type='text/javascript'>alert('錯誤');</script>";
        echo '
            <meta http-equiv=REFRESH CONTENT=0;url=profile.php?id=' . (int)$_GET['id'] . '>';
    }
}

//addfriend

if (isset($_POST['action'])) {
    $sender = $_SESSION['id'];
    $reciver = $_GET['id'];
    $action = $_POST['action'];


    //if you already friend, can not request
    $sql = "SELECT * FROM friends WHERE user_one = ? AND user_two = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute(array($sender, $reciver));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        echo json_encode(0);
        return;
    }
    //check again mirror 
    $sql = "SELECT * FROM friends WHERE user_one = ? AND user_two = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute(array($reciver, $sender));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        echo json_encode(0);
        return;
    }

    //first check if duplicate
    $sql = "SELECT *  FROM friend_request WHERE sender = $sender AND receiver = $reciver";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        echo json_encode(0);
        return;
    }
    //check again mirror
    $sql = "SELECT *  FROM friend_request WHERE sender = $reciver AND receiver = $sender";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        echo json_encode(0);
        return;
    }

    //add request
    if ($action == "addf") {
        $sql = "INSERT INTO friend_request (sender, receiver) 
        VALUES ( ?, ?)";
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array($sender, $reciver));
    }

    echo json_encode(1);
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>profile</title>
    <link rel="stylesheet" href="css/stylei.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <script src="js/weather.js" defer></script>
    <script src="js/clock.js"></script>
    <script src="js/addfriend.js"></script>
    <!-- Remember to include jQuery :) -->


    <!-- jQuery Modal -->

</head>

<body>
    <!-- partial:index.partial.html -->

    <body>
        <!-- modal -->
        <div id="ex1" class="modal" style="background:#4d3d6238">
            <form action="profile.php?&id=<?php echo (int)$_GET["id"]; ?>" method="post">


                <label class="menu-box-tab"><span>&nbsp <?php echo '真實姓名：<input  name="udpaterealname" id="udpaterealname">'; ?> </span></label>
                <label class=" menu-box-tab"><span>&nbsp <?php echo '生日：<input type="date" name="updatebirth" id="updatebirth" >'; ?> </span></label>
                <label class=" menu-box-tab"><span>&nbsp <?php echo '年齡：<input type="number" name="updateage" id="updateage">'; ?> </span></label>
                <label class=" menu-box-tab"><span>&nbsp <?php echo '<input type="submit" name="updatepersonalfile">'; ?> </span></label>

            </form>
            <a href=" #" rel="modal:close">Close</a>
        </div>
        <div class="main-container">
            <!-- HEADER -->
            <header class="block">
                <ul class="header-menu horizontal-list">

                    <li>
                        <a class="header-menu-tab" href="message.php?&id=<?php echo $_SESSION['id']; ?>"><span class="icon fontawesome-envelope scnd-font-color"></span>Messages</a>

                    </li>
                    <li>
                        <a class="header-menu-tab" href="invite.php"><span class="icon fontawesome-user scnd-font-color"></span>用戶</a>
                    </li>

                    <li>
                        <a class="header-menu-tab" href="request.php?&id=<?php echo $_SESSION['id']; ?>"><span class="icon fontawesome-check scnd-font-color"></span>request</a>
                    </li>
                    <li>
                        <a class="header-menu-tab" href="friendlist.php?&id=<?php echo $_SESSION['id']; ?>"><span class="icon fontawesome-star-empty scnd-font-color"></span>friendlist</a>
                    </li>
                    <li>
                        <a class="header-menu-tab" href="profile.php?&id=<?php echo $_SESSION['id']; ?>"><span></span>個人頁面</a>
                    </li>
                    <li>
                        <a class="header-menu-tab" href="change.php"><span></span>更改密碼</a>
                    </li>
                    <li>
                        <a class="header-menu-tab" href="logout.php"><span></span>sign out</a>
                    </li>

                </ul>

            </header>

            <!-- LEFT-CONTAINER -->
            <div class="left-container container">
                <div class="menu-box block">
                    <!-- MENU BOX (LEFT-CONTAINER) -->
                    <a href="boardlist.php">
                        <h2 class="titular">看板連結</h2>
                    </a>
                    <ul class="menu-box-menu">
                        <li>
                            <a class="menu-box-tab" href="viewboard.php?&id=1"><span>&nbsp </span>movie
                                <div </li>
                        <li>
                            <a class="menu-box-tab" href="viewboard.php?&id=3"><span>&nbsp </span>joke<div </li>
                        <li>
                            <a class="menu-box-tab" href="viewboard.php?&id=2"><span>&nbsp </span>Gossip<div < /li>
                        <li>
                            <a class="menu-box-tab" href="viewboard.php?&id=5"><span>&nbsp </span>MEMES</a>
                        </li>
                        <li>
                            <a class="menu-box-tab" href="viewboard.php?&id=4"><span>&nbsp </span>school</a>
                        </li>
                    </ul>
                </div>
                <div class="menu-box block">
                    <br>
                    <div class="clock">
                        <div class="time"></div>
                    </div>

                </div>
            </div>
            <!-- MIDDLE-CONTAINER -->
            <div class="middle-container container">
                <div class="profile block">
                    <!-- PROFILE (MIDDLE-CONTAINER) -->
                    <br>
                    <br>
                    <br>
                    <br>

                    <?php
                    include("includes/pdoInc.php");
                    $sth = $dbh->prepare('SELECT * FROM users WHERE id = ?');
                    $sth->execute(array((int)$_GET['id']));
                    $row = $sth->fetch(PDO::FETCH_ASSOC);
                    echo '<div class="profile-picture big-profile-picture clear">
                        <img width="150px" alt="123" src="includes/uploads/' . $row['image'] . '">
                    </div>';
                    echo '<h1 class="user-name">' . $row["username"] . '</h1>';

                    echo '<br>';
                    echo '<br>';
                    if ($row['username'] == $_SESSION["username"]) {
                        echo '<form class="comments" action="includes/uploadimage.php?&id=' . $_GET["id"] . '" method="post" enctype="multipart/form-data">';
                        echo '<label class="menu-box-tab" " ><input type="file" name="file"><br><span></span></label>';

                        echo '<input type="submit" style="background-color: #5a5d69de;" name="submit">';
                        echo '</form>';
                    }
                    ?>
                    </li>

                </div>
                <div class="profile block">
                    <img width="300px" src="./includes/ad.PNG" alt="廣告投放區">
                    <a href="https://line.me/S/sticker/14458898">
                        <h1>&nbsp 貼圖可愛的大熊熊販賣中!!!!</h1>
                        <h1>&nbsp 貼圖可愛的大熊熊販賣中!!!!</h1>
                        <h1>&nbsp 貼圖可愛的大熊熊販賣中!!!!</h1>
                    </a>
                </div>
            </div>

            <!-- RIGHT-CONTAINER -->
            <div class="right-container container">

                <div class="account block">
                    <?php
                    include("includes/pdoInc.php");
                    $sth = $dbh->prepare('SELECT * FROM users WHERE id = ?');
                    $sth->execute(array((int)$_GET['id']));
                    $row = $sth->fetch(PDO::FETCH_ASSOC);
                    echo '<br>';
                    echo '<br>';
                    echo '<br>';
                    echo '<label class="menu-box-tab" ><span>&nbsp用戶暱稱 :' . $row['username'] . '</span></label>';
                    echo '<label class="menu-box-tab" ><span>&nbsp真實姓名 :' . $row['realName'] . '</span></label>';
                    echo '<label class="menu-box-tab" ><span>&nbsp生日 :' . $row['birth'] . '</span></label>';
                    echo '<label class="menu-box-tab" ><span>&nbsp年齡 :' . $row['age'] . '</span></label>';

                    //edit button
                    if ($row['username'] == $_SESSION['username']) {
                        echo '<p><a href="#ex1" rel="modal:open">edit</a></p>';
                    } else {

                        //to show  button
                        $sender = $_SESSION['id'];
                        $reciver = (int)$_GET['id'];

                        // first check already friend or not
                        $sql = "SELECT *  FROM friends WHERE user_one = $reciver AND user_two = $sender";
                        $sth = $dbh->prepare($sql);
                        $sth->execute();
                        $rowa = $sth->fetch(PDO::FETCH_ASSOC);

                        $sql = "SELECT *  FROM friends WHERE user_one = $sender AND user_two = $reciver";
                        $stmt = $dbh->prepare($sql);
                        $stmt->execute();
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        if ($row || $rowa) {
                            echo '<button disabled data-url="' . (int)$_GET["id"] . '">已是朋友</button>';
                        } else {
                            // then check be invited or not not?
                            $sql = "SELECT *  FROM friend_request WHERE sender = $reciver AND receiver =$sender ";
                            $stmt = $dbh->prepare($sql);
                            $stmt->execute();
                            $row = $stmt->fetch(PDO::FETCH_ASSOC);
                            if ($row) {
                                echo '<a href="request.php?id=' . $_SESSION['id'] . '"><button>回覆對方的好友邀請</button></a>';
                            } else {
                                // last check send request or not
                                $sql = "SELECT *  FROM friend_request WHERE sender = $sender AND receiver = $reciver";
                                $stmt = $dbh->prepare($sql);
                                $stmt->execute();
                                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                if ($row) {
                                    echo '<button disabled data-url="' . (int)$_GET["id"] . '">sended</button>';
                                } else {
                                    echo '<button class="addf" data-url="' . (int)$_GET["id"] . '">加好友</button>';
                                }
                            }
                        }
                    }

                    ?>

                </div> <!-- end right-container -->
                <div class="calendar-month block">
                    <!-- CALENDAR MONTH (RIGHT-CONTAINER) -->
                    <div class="weather-app">
                        <div class="card">
                            <div class="search">
                                <input type="text" class="search-bar" placeholder="Search">
                                <button class="btnweather"><svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024" height="1.5em" width="1.5em" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M909.6 854.5L649.9 594.8C690.2 542.7 712 479 712 412c0-80.2-31.3-155.4-87.9-212.1-56.6-56.7-132-87.9-212.1-87.9s-155.5 31.3-212.1 87.9C143.2 256.5 112 331.8 112 412c0 80.1 31.3 155.5 87.9 212.1C256.5 680.8 331.8 712 412 712c67 0 130.6-21.8 182.7-62l259.7 259.6a8.2 8.2 0 0 0 11.6 0l43.6-43.5a8.2 8.2 0 0 0 0-11.6zM570.4 570.4C528 612.7 471.8 636 412 636s-116-23.3-158.4-65.6C211.3 528 188 471.8 188 412s23.3-116.1 65.6-158.4C296 211.3 352.2 188 412 188s116.1 23.2 158.4 65.6S636 352.2 636 412s-23.3 116.1-65.6 158.4z">
                                        </path>
                                    </svg></button>
                            </div>
                            <div class="weather loading">
                                <h2 class="city">Weather in Taipei</h2>
                                <h1 class="temp">51°C</h1>
                                <div class="flex">
                                    <img src="https://openweathermap.org/img/wn/04n.png" alt="" class="icon" />
                                    <div class="description">Cloudy</div>
                                </div>
                                <div class="humidity">Humidity: 60%</div>
                                <div class="wind">Wind speed: 6.2 km/h</div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end calendar-month block -->
            </div> <!-- end main-container -->
    </body>
    <!-- partial -->
</body>

</html>