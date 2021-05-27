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
                <div>
                    <?php
                    include("includes/pdoInc.php");
                    if (isset($_GET['id'])) {
                        $stmt = $dbh->prepare("SELECT * from dz_board where id = ?");
                        $stmt->execute([$_GET["id"]]);
                        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo '<h2 class="titular" style="background: #11a8ab;">看板' . $row["name"] . '</h2>';
                        } else {
                            echo '<meta http-equiv=REFRESH CONTENT=0;url=boardlist.php>';
                        }
                    } else {
                        echo '<meta http-equiv=REFRESH CONTENT=0;url=boardlist.php>';
                    }


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
            <div class="middle-container container" style="width: 600px;height: 250px;">
                <div class="profile block" style="height: 250px;">
                    <form action="123" method="post" enctype="multipart/form-data">
                        <label class="menu-box-tab" style="background: #50597b;"><span>&nbsp <?php if (!empty($_SESSION["username"])) {
                                                                                                    echo "暱稱: " . $_SESSION["username"];
                                                                                                } else {
                                                                                                    echo "訪客";
                                                                                                }  ?></span></label>
                        <label class="menu-box-tab" " style=" background: #50597b;"><span>&nbsp <?php echo '主題：<input name="title" maxlength="100"><br>'; ?> </span></label>
                        <label class="menu-box-tab" " style=" background: #50597b;"><span>&nbsp <?php echo '內容：<textarea name="content" style="vertical-align: middle;" ></textarea>'; ?> </span></label>
                        <label class="menu-box-tab" " style=" background: #50597b;"><span>&nbsp <?php echo '附件: <input type="file" name="file">' . '<input type="submit" name="submit">'; ?> </span></label>
                    </form>
                </div>
            </div>

        </div>

    </body>
    <!-- partial -->
</body>

</html>