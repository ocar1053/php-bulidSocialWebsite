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
            <!-- LEFT-CONTAINER -->
            <div class="left-container container">
                <div>
                    <!-- MENU BOX (LEFT-CONTAINER) -->
                    <h2 class="titular" style="background: #11a8ab;">所有看板</h2>
                    <ul>
                        <?php
                        include("includes/pdoInc.php");
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
        </div>

    </body>
    <!-- partial -->
</body>

</html>