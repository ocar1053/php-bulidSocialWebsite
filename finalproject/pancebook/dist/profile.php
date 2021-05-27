<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>CodePen - Freebie Interactive Flat Design UI / Only HTML5 &amp; CSS3</title>
    <link rel="stylesheet" href="css/stylei.css">
</head>

<body>
    <!-- partial:index.partial.html -->

    <body>

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
                        <a class="header-menu-tab" href="#5"><span></span>sign out</a>
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
                            <a class="menu-box-tab" href="viewBoard.php&id=1"><span>&nbsp </span>movie
                                <div </li>
                        <li>
                            <a class="menu-box-tab" href="viewBoard.php&id=3"><span>&nbsp </span>joke<div </li>
                        <li>
                            <a class="menu-box-tab" href="viewBoard.php&id=2"><span>&nbsp </span>Gossip<div < /li>
                        <li>
                            <a class="menu-box-tab" href="viewBoard.php&id=5"><span>&nbsp </span>MEMES</a>
                        </li>
                        <li>
                            <a class="menu-box-tab" href="viewBoard.php&id=4"><span>&nbsp </span>scool</a>
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
                    <?php
                    include("includes/pdoInc.php");
                    $sth = $dbh->prepare('SELECT * FROM users WHERE id = ?');
                    $sth->execute(array((int)$_GET['id']));
                    $row = $sth->fetch(PDO::FETCH_ASSOC);
                    echo '<div class="profile-picture big-profile-picture clear">
                        <img width="150px" alt="123" src="includes/uploads/' . $row['image'] . '">
                    </div>';
                    echo '<h1 class="user-name">' . $_SESSION["username"] . '</h1>';
                    ?>
                    <br>
                    <br>
                    <form class="comments" action="includes/uploadimage.php?&id=<?php echo $_GET['id'] ?>" method="post" enctype="multipart/form-data">
                        <label class="menu-box-tab" " style=" background: #50597b;"><input type="file" name="file"><br><span></span></label>

                        <input type="submit" style="background-color:#50597b;" name="submit">
                    </form>
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