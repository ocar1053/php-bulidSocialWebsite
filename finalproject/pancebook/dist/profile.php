<?php
session_start();
include('includes/pdoInc.php');

// edit personalile
if (isset($_POST['updatepersonalfile'])) {
    $birth = htmlspecialchars($_POST['updatebirth']);
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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>CodePen - Freebie Interactive Flat Design UI / Only HTML5 &amp; CSS3</title>
    <link rel="stylesheet" href="css/stylei.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <script src="test.js"></script>

    <!-- Remember to include jQuery :) -->


    <!-- jQuery Modal -->

</head>

<body>
    <!-- partial:index.partial.html -->

    <body>
        <!-- modal -->
        <div id="ex1" class="modal" style="background:#4d3d6238">
            <form action="profile.php?&id=<?php echo (int)$_GET["id"]; ?>" method="post">


                <label class="menu-box-tab" " style=" background: #50597b;"><span>&nbsp <?php echo '真實姓名：<input  name="udpaterealname" id="udpaterealname">'; ?> </span></label>
                <label class="menu-box-tab" " style=" background: #50597b;"><span>&nbsp <?php echo '生日：<input type="date" name="updatebirth" id="updatebirth" >'; ?> </span></label>
                <label class="menu-box-tab" " style=" background: #50597b;"><span>&nbsp <?php echo '年齡：<input type="number" name="updateage" id="updateage">'; ?> </span></label>
                <label class="menu-box-tab" " style=" background: #50597b;"><span>&nbsp <?php echo '<input type="submit" name="updatepersonalfile">'; ?> </span></label>

            </form>
            <a href="#" rel="modal:close">Close</a>
        </div>
        <div class="main-container">
            <!-- HEADER -->
            <header class="block">
                <ul class="header-menu horizontal-list">

                    <li>
                        <a class="header-menu-tab" href="#3"><span class="icon fontawesome-envelope scnd-font-color"></span>Messages</a>

                    </li>
                    <li>
                        <a class="header-menu-tab" href="#2"><span class="icon fontawesome-user scnd-font-color"></span>invite</a>
                    </li>

                    <li>
                        <a class="header-menu-tab" href="#5"><span class="icon fontawesome-star-empty scnd-font-color"></span>friend</a>
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
                            <a class="menu-box-tab" href="viewBoard.php?&id=1"><span>&nbsp </span>movie
                                <div </li>
                        <li>
                            <a class="menu-box-tab" href="viewBoard.php?&id=3"><span>&nbsp </span>joke<div </li>
                        <li>
                            <a class="menu-box-tab" href="viewBoard.php?&id=2"><span>&nbsp </span>Gossip<div < /li>
                        <li>
                            <a class="menu-box-tab" href="viewBoard.php?&id=5"><span>&nbsp </span>MEMES</a>
                        </li>
                        <li>
                            <a class="menu-box-tab" href="viewBoard.php?&id=4"><span>&nbsp </span>school</a>
                        </li>
                    </ul>
                </div>
                <div class="menu-box block">
                    <br>
                    <div class="clock">
                        <div class="time"></div>
                    </div>
                    <script src="./clock.js"></script>
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
                        echo '<label class="menu-box-tab" " style=" background: #50597b;"><input type="file" name="file"><br><span></span></label>';

                        echo '<input type="submit" style="background-color:#50597b;" name="submit">';
                        echo '</form>';
                    }
                    ?>
                    </li>

                </div>
                <div class="profile block">
                    <img width="300px" src="./ad.PNG" alt="廣告投放區">
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
                    echo '<label class="menu-box-tab" " style=" background: #50597b;"><span>&nbsp用戶暱稱 :' . $row['username'] . '</span></label>';
                    echo '<label class="menu-box-tab" " style=" background: #50597b;"><span>&nbsp真實姓名 :' . $row['realName'] . '</span></label>';
                    echo '<label class="menu-box-tab" " style=" background: #50597b;"><span>&nbsp生日 :' . $row['birth'] . '</span></label>';
                    echo '<label class="menu-box-tab" " style=" background: #50597b;"><span>&nbsp年齡 :' . $row['age'] . '</span></label>';
                    if ($row['username'] == $_SESSION['username'])  echo '<p><a href="#ex1" rel="modal:open">edit</a></p>';
                    ?>
                </div> <!-- end right-container -->
                <div class="calendar-month block">
                    <!-- CALENDAR MONTH (RIGHT-CONTAINER) -->
                    <div class="arrow-btn-container">
                        <br>
                        <br>
                        <br>

                        <br>

                        <h2 class="titular" id="titularyear" style="
    border-top-left-radius: 0px;
    border-top-right-radius: 0px;
">2013</h2>

                        <h2 class="titular" id="titularmonth" style="
    border-top-left-radius: 0px;
    border-top-right-radius: 0px;
">2013</h2>

                        <h2 class="titular" id="titularday" style="
    border-top-left-radius: 0px;
    border-top-right-radius: 0px;
">2013</h2>

                        <h2 class="titular" id="titularweek" style="
    border-top-left-radius: 0px;
    border-top-right-radius: 0px;
">2013</h2>
                    </div>
                    <script src="./calender.js"></script>
                </div> <!-- end calendar-month block -->
            </div> <!-- end main-container -->


    </body>
    <!-- partial -->
</body>

</html>