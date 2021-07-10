<?php
session_start();
if (!isset($_SESSION['id'])) header("Location:login.php");
include('includes/pdoInc.php');
if ($_GET['id'] != $_SESSION['id']) {
    header("Location:..//request.php?&id=" . $_SESSION['id']);
    exit();
}

function cantor_pair_calculate($x, $y) // get unique chatrooomid
{
    $temp = $x;
    if ($x > $y) // sort
    {
        $x = $y;
        $y = $temp;
    }
    return (($x + $y) * ($x + $y + 1)) / 2 + $y;
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


    $decode = base64_decode($_POST["tableid"]); //解密 
    $table = (int)$decode;
    $receiver = $_SESSION['id'];
    //check receiver
    $sql = "SELECT * FROM friend_request WHERE  id = $table";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) { // check if exist
        if ($row['receiver'] != $_SESSION['id']) {
            echo "<script type='text/javascript'>alert('錯誤');</script>";
            echo '<meta http-equiv=REFRESH CONTENT=0;url=request.php?&id=' . $_SESSION['id'] . '>';
        } else {
            $sender = $row['sender'];
        }
    } else {
        header('Location:..//request.php?id=' . $_SESSION['id'] . '');
        exit();
    }


    //delete old pending
    if ($action == "ac") {
        $sql = "DELETE FROM friend_request WHERE id = ?";
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array($table));
    } else if ($action == "refuse") {
        $sql = "DELETE FROM friend_request WHERE id = ?";
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array($table));
        echo json_encode(123);
        return;  //refuse stop here
    }


    //add as friend
    $sql = "INSERT INTO friends (user_one, user_two) 
    VALUES (?, ?)";
    $stmt = $dbh->prepare($sql);
    $stmt->execute(array($post_id, $sender));
    //add chat room for them
    $sql = "INSERT INTO chatroomlist (roomid) 
    VALUES (?)";
    $stmt = $dbh->prepare($sql);
    $roomid = cantor_pair_calculate($sender, $receiver);
    $stmt->execute(array($roomid));

    echo json_encode($table);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>request</title>
    <!-- Remember to include jQuery :) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>

    <!-- jQuery Modal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <link rel="stylesheet" href="css/stylei.css">
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
                $stmt = $dbh->prepare("SELECT *, users.id AS NEW
                FROM users
                JOIN friend_request
                ON friend_request.sender = users.id
                WHERE status = 'pending' AND receiver = ? ");
                $stmt->execute(array($_GET['id']));
                while (($row = $stmt->fetch(PDO::FETCH_ASSOC))) {

                    //加密
                    $rowid = strval($row['id']);
                    $rowing = base64_encode($rowid);
                    echo '<label class="menu-box-tab" " style=" background: #50597b;color: white;">&nbsp;&nbsp;' . $row['username'] .
                        '&nbsp<button class="ac"
                data-tableid="' . $rowing . '"
                 data-id="' . $row['receiver'] . '"
                 > 同意</button>' .
                        '&nbsp<button class="refuse" 
                data-tableid="' . $rowing . '"
                data-id="' . $row['receiver'] . '"
                > 不同意</button>' .

                        '&nbsp;&nbsp;<a href="profile.php?&id=' . $row['NEW'] . '">個人檔案</a>' . '</label>';
                }

                ?>
            </div>
            <script src="js/request.js"></script>

        </div>

    </body>
    <!-- partial -->
</body>

</html>