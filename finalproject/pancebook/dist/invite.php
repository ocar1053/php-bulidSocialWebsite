<?php
session_start();
include('includes/pdoInc.php');


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>CodePen - Freebie Interactive Flat Design UI / Only HTML5 &amp; CSS3</title>
    <!-- Remember to include jQuery :) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>

    <!-- jQuery Modal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <link rel="stylesheet" href="css/stylei.css">
    <script src="test.js"></script>
</head>

<body>
    <!-- partial:index.partial.html -->

    <body>
        <!-- modal -->


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
                <div>
                    <?php
                    include("includes/pdoInc.php");
                    echo '<ul>';
                    $stmt = $dbh->prepare("SELECT * from dz_board");
                    $stmt->execute();
                    while (($row = $stmt->fetch(PDO::FETCH_ASSOC))) {
                        echo ' <li>
                            <a class="menu-box-tab" href="viewboard.php?&id=' . $row['id'] . '" style="background: #50597b;"><span>&nbsp </span>' . $row["name"] . '</a>
                        </li> ';
                    }
                    ?>
                    </ul>
                </div>

            </div>
            <div class="middle-container container" style="width: 600px;height: 190px;">
                <?php

                $stmt = $dbh->prepare("SELECT *
                FROM users");
                $stmt->execute();
                while (($row = $stmt->fetch(PDO::FETCH_ASSOC))) {
                    if ($row["username"] == $_SESSION["username"]) {
                        continue;
                    }
                    echo '<label class="menu-box-tab" " style=" background: #50597b;">&nbsp;&nbsp;' . $row['username'] .
                        '&nbsp
                        <a href="profile.php?id=' . $row['id'] . '">個人檔案連結</a>' .
                        '</label>';
                }

                ?>
            </div>


        </div>

    </body>
    <!-- partial -->
</body>

</html>