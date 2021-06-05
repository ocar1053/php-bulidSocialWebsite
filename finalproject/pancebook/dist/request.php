<?php
session_start();
include('includes/pdoInc.php');
if ($_GET['id'] != $_SESSION['id']) {
    header("Location:..//request.php?&id=" . $_SESSION['id']);
    exit();
}

//request handle
if (isset($_POST["action"])) {
    $post_id = $_POST["urlid"];
    if ($post_id != $_SESSION['id']) {
        echo "<script type='text/javascript'>alert('錯誤');</script>";
        echo '<meta http-equiv=REFRESH CONTENT=0;url=request.php?&id=' . $_SESSION['id'] . '>';
    }
    $sender = null;
    $action = $_POST["action"];
    $table = (int)$_POST["tableid"];
    //check receiver
    $sql = "SELECT * FROM friend_request WHERE  id = $table";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { // check if exist
        if ($row['receiver'] != $_SESSION['id']) {
            echo "<script type='text/javascript'>alert('錯誤');</script>";
            echo '<meta http-equiv=REFRESH CONTENT=0;url=request.php?&id=' . $_SESSION['id'] . '>';
        } else {
            $sender = $row['sender'];
        }
    } else {
        echo "<script type='text/javascript'>alert('錯誤');</script>";
        echo '<meta http-equiv=REFRESH CONTENT=0;url=request.php?&id=' . $_SESSION['id'] . '>';
    }


    //delete old pending
    if ($action == "ac") {
        $sql = "DELETE FROM friend_request WHERE id = $table";
        $stmt = $dbh->query($sql);
    } else if ($action == "refuse") {
        $sql = "DELETE FROM friend_request WHERE id = $table";
        $stmt = $dbh->query($sql);

        echo json_encode(123);
        return;
    }
    //add as friend
    $sql = "INSERT INTO friends (user_one, user_two) 
    VALUES ($post_id, $sender)";
    $stmt = $dbh->query($sql);

    echo json_encode(123);
}
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
                        <a class="header-menu-tab" href="#3"><span class="icon fontawesome-envelope scnd-font-color"></span>Messages</a>

                    </li>
                    <li>
                        <a class="header-menu-tab" href="invite.php?&id=<?php echo $_GET['id']; ?>"><span class="icon fontawesome-user scnd-font-color"></span>用戶</a>
                    </li>

                    <li>
                        <a class="header-menu-tab" href="request.php?&id=<?php echo $_GET['id']; ?>"><span class="icon fontawesome-star-empty scnd-font-color"></span>request</a>
                    </li>
                    <li>
                        <a class="header-menu-tab" href="friendlist.php?&id=<?php echo $_GET['id']; ?>"><span class="icon fontawesome-star-empty scnd-font-color"></span>friendlist</a>
                    </li>
                    <li>
                        <a class="header-menu-tab" href="profile.php?&id=<?php echo $_SESSION['id']; ?>"><span></span>個人頁面</a>
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
                FROM users
                JOIN friend_request
                ON friend_request.sender = users.id
                WHERE status = 'pending' AND receiver = ? ");
                $stmt->execute(array($_GET['id']));
                while (($row = $stmt->fetch(PDO::FETCH_ASSOC)))
                    echo '<label class="menu-box-tab" " style=" background: #50597b;">&nbsp;&nbsp;' . $row['username'] .
                        '&nbsp<button class="ac"
                    data-tableid="' . $row['id'] . '"
                     data-id="' . $row['receiver'] . '"
                     > 同意</button>' .
                        '&nbsp<button class="refuse" 
                    data-tableid="' . $row['id'] . '"
                    data-id="' . $row['receiver'] . '"
                    > 不同意</button>' .
                        '</label>';

                ?>
            </div>
            <script src="request.js"></script>

        </div>

    </body>
    <!-- partial -->
</body>

</html>