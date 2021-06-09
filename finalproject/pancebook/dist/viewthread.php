<?php
session_start();
include('includes/pdoInc.php');

function showMsg($row, $numFloor)
{
    $nn = htmlspecialchars($row['username']);
    $msg = htmlspecialchars($row['content']);
    $msg = str_replace("\n", "<br>", $msg);
    if ($numFloor == 0) {
        echo '<label class="menu-box-tab" " style=" background: #50597b;"><span>&nbsp 討論串主題：' . $row["title"] . '</span></label><br>';
    }
    if ($numFloor + 1 == 1) {
        if ($_SESSION["username"] == $row["username"]) echo '<span>#' . ($numFloor + 1) . '&nbsp' . '</span>' . '<span><a value="' . $row["id"] . '" class="edit" href="#ex1" rel="modal:open">編輯</a></span>';
        else echo '<span>#' . ($numFloor + 1) . '&nbsp' . '</span>';
        echo '<table border=\'7\'><tr>';
        echo '<td  style="
        color: white;font-family: fangsong;
    ">留言人: ' . $nn . '</td>';
        echo '<td style="
        color: white;font-family: fangsong;
    ">時間: ' . $row["time"] . '</td>';
        echo '<td style="
        color: white;font-family: fangsong;
    ">位置: ' . $row["ip"] . '</td></tr>';
        echo '<tr><td style="
        color: white;font-family: fangsong;
    " colspan=\'3\'>主題討論內容:<br>' . $msg . '</td></tr></table><br>';
        echo '<hr>';
    } else {
        if ($_SESSION["username"] == $row["username"]) echo '<span>#' . ($numFloor + 1) . '&nbsp' . '</span>' . '<span><a value="' . $row["id"] . '" class="edit" href="#ex1" rel="modal:open">編輯</a></span>';
        else echo '<span>#' . ($numFloor + 1) . '&nbsp' . '</span>';
        if ($_SESSION["username"] == $row["username"]) echo
        '<a href="' .
            basename($_SERVER['PHP_SELF']) . '?id=' . (int)$_GET['id'] . '&del=' . $row['id'] .
            '">&nbsp刪除</a>';
        echo '<table border=\'2\'><tr>';
        echo '<td  style="
        color: white;font-family: fangsong;
    ">留言人: ' . $nn . '</td>';
        echo '<td style="
        color: white;font-family: fangsong;
    ">時間: ' . $row["time"] . '</td>';
        echo '<td style="
        color: white;font-family: fangsong;
    ">位置: ' . $row["ip"] . '</td></tr>';
        echo '<tr><td style="
        color: white;font-family: fangsong;
    " colspan=\'3\'>回覆:<br>' . $msg . '</td></tr></table><br>';
    }
}

//following is updload viewthread

if (isset($_POST['submit']) && isset($_GET['id'])) {
    $content = $_POST['content'];
    if (empty($_SESSION['id'])) {
        echo "<script type='text/javascript'>alert('訪客不可發表回應');</script>";
        echo '<meta http-equiv=REFRESH CONTENT=0;url=viewThread.php?id=' . (int)$_GET['id'] . '>';
    } else if (empty($content)) {
        echo "<script type='text/javascript'>alert('請填寫完整資料');</script>";
        echo '<meta http-equiv=REFRESH CONTENT=0;url=viewThread.php?id=' . (int)$_GET['id'] . '>';
    } else {
        $sth = $dbh->prepare('SELECT id FROM dz_thread WHERE id = ? and board_id <> 0');
        $sth->execute(array((int)$_GET['id']));
        if ($sth->rowCount() > 0) {
            $sth2 = $dbh->prepare(
                'INSERT INTO dz_thread (username, content, ip, root_thread_id) VALUES (?, ?, ?, ?)'
            );
            $sth2->execute(array(
                $_SESSION['username'],
                $_POST['content'],
                $_SERVER['REMOTE_ADDR'],
                (int)$_GET['id']
            ));
            echo "<script type='text/javascript'>alert('發表回應成功');</script>";
            echo '<meta http-equiv=REFRESH CONTENT=0;url=viewThread.php?id=' . (int)$_GET['id'] . '>';
        }
    }
}

//update
if (isset($_POST['update'])) {
    $id = $_POST['updateid'];
    $sth = $dbh->prepare('SELECT * FROM dz_thread WHERE id = ?');
    $sth->execute(array((int)$id));
    if ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
        //權限管控 
        if ($row['username'] == $_SESSION['username']) {
            $sql = 'UPDATE dz_thread SET content = ? WHERE id = ?';
            $sth = $dbh->prepare($sql);
            $sth->execute(array($_POST['updatecontent'], $id));
            echo "<script type='text/javascript'>alert('編輯成功');</script>";
            echo '
            <meta http-equiv=REFRESH CONTENT=0;url=viewThread.php?id=' . (int)$_GET['id'] . '>';
        } else {
            echo "<script type='text/javascript'>alert('權限不足');</script>";
            echo '
            <meta http-equiv=REFRESH CONTENT=0;url=viewThread.php?id=' . (int)$_GET['id'] . '>';
        }
    } else {
        echo "<script type='text/javascript'>alert('錯誤');</script>";
        echo '
            <meta http-equiv=REFRESH CONTENT=0;url=viewThread.php?id=' . (int)$_GET['id'] . '>';
    }
}

//delete
if (isset($_GET['del'])) {
    // first check who deletes 
    $sth = $dbh->prepare('SELECT * FROM dz_thread WHERE id = ?');
    $sth->execute(array((int)$_GET['del']));
    if ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
        // for safety can't delete first floor 
        if ($row['root_thread_id'] == 0) {
            echo "<script type='text/javascript'>alert('不可刪除1樓');</script>";
            echo
            '<meta http-equiv=REFRESH CONTENT=0;url=' .
                basename($_SERVER['PHP_SELF']) . '?id=' . (int)$_GET['id'] . '>';
        } else if ($row['username'] == $_SESSION['username']) {
            $sth = $dbh->prepare('DELETE FROM dz_thread WHERE id = ? or root_thread_id = ?');
            $sth->execute(array((int)$_GET['del'], (int)$_GET['del']));
            echo "<script type='text/javascript'>alert('刪除成功');</script>";
            echo
            '<meta http-equiv=REFRESH CONTENT=0;url=' .
                basename($_SERVER['PHP_SELF']) . '?id=' . (int)$_GET['id'] . '>';
        } else {
            echo "<script type='text/javascript'>alert('權限不足');</script>";
            echo
            '<meta http-equiv=REFRESH CONTENT=0;url=' .
                basename($_SERVER['PHP_SELF']) . '?id=' . (int)$_GET['id'] . '>';
        }
    } else {
        echo "<script type='text/javascript'>alert('錯誤');</script>";
        echo '
        <meta http-equiv=REFRESH CONTENT=0;url=viewThread.php?id=' . (int)$_GET['id'] . '>';
    }
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
        <div id="ex1" class="modal" style="background:#4d3d6238">
            <form action="viewthread.php?&id=<?php echo (int)$_GET["id"]; ?>" method="post" enctype="multipart/form-data">

                <?php echo '<input type="hidden" name="updateid" id ="updateid">'; ?>
                <label class="menu-box-tab" style="background: #50597b;"><span>&nbsp <?php if (!empty($_SESSION["username"])) {
                                                                                            echo "暱稱: " . $_SESSION["username"];
                                                                                        } else {
                                                                                            echo "訪客";
                                                                                        }  ?></span></label>
                <label class="menu-box-tab" " style=" background: #50597b;"><span>&nbsp <?php echo '更改內容：<textarea name="updatecontent" style="vertical-align: middle;" ></textarea>'; ?> </span></label>
                <label class="menu-box-tab" " style=" background: #50597b;"><span>&nbsp <?php echo '<input type="submit" name="update">'; ?> </span></label>

            </form>
            <a href="#" rel="modal:close">Close</a>
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
                        <a class="header-menu-tab" href="request.php?&id=<?php echo $_SESSION['id']; ?>"><span class="icon fontawesome-star-empty scnd-font-color"></span>request</a>
                    </li>
                    <li>
                        <a class="header-menu-tab" href="friendlist.php?&id=<?php echo $_SESSION['id']; ?>"><span class="icon fontawesome-star-empty scnd-font-color"></span>friendlist</a>
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
                    if (isset($_GET['id'])) {

                        //using join to show board name 
                        $stmt = $dbh->prepare("SELECT * FROM dz_thread JOIN dz_board ON dz_thread.board_id = dz_board.id  WHERE dz_thread.id = ?");
                        $stmt->execute([(int)$_GET["id"]]);
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
            <div class="middle-container container" style="width: 600px;height: 190px;">
                <div class="profile block" style="height: 190px;">
                    <form action="viewthread.php?&id=<?php echo (int)$_GET["id"]; ?>" method="post" enctype="multipart/form-data">
                        <label class="menu-box-tab" style="background: #50597b;"><span>&nbsp <?php if (!empty($_SESSION["username"])) {
                                                                                                    echo "暱稱: " . $_SESSION["username"];
                                                                                                } else {
                                                                                                    echo "訪客";
                                                                                                }  ?></span></label>
                        <label class="menu-box-tab" " style=" background: #50597b;"><span>&nbsp <?php echo '回應：<textarea name="content" style="vertical-align: middle;" ></textarea>'; ?> </span></label>
                        <label class="menu-box-tab" " style=" background: #50597b;"><span>&nbsp <?php echo '<input type="submit" name="submit">'; ?> </span></label>

                    </form>
                    <br>
                    <!-- to get editting id -->
                    <!-- Link to open the modal -->
                    <?php
                    if (isset($_GET['id'])) {
                        $sth = $dbh->prepare('
                            SELECT * from dz_thread
                            WHERE (id = ? and board_id != 0)
                            OR (root_thread_id = ?)
                            ORDER BY id');
                        $sth->execute(array((int)$_GET['id'], (int)$_GET['id']));
                        if ($sth->rowCount() > 0) {
                            $numFloor = 0;
                            while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
                                showMsg($row, $numFloor++);
                            }
                        } else {
                            echo "<script type='text/javascript'>alert('error');</script>";
                        }
                    } else {
                        echo "<script type='text/javascript'>alert('error');</script>";
                    }
                    ?>
                </div>
            </div>

        </div>

    </body>
    <!-- partial -->
</body>

</html>