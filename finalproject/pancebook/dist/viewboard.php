<?php
session_start();
include('includes/pdoInc.php');

//folling is updload 討論串
// first situation -> you want to update file
if (isset($_POST['submit']) && isset($_GET['id']) && isset($_FILES['file']) && $_FILES["file"]["name"] != NULL) {
    $title = htmlspecialchars($_POST['title']);
    $content = htmlspecialchars($_POST['content']);
    //handle fileupdate
    $blackList = array('jpg', 'png', 'jpeg');
    $newDir =   "./includes/uploads";
    $newDir = str_replace("'", "", $newDir);
    $extension =  htmlspecialchars(@strtolower(end(explode('.', $_FILES["file"]["name"])))); // get extension
    $newFileName = uniqid('', true) . "." . $extension; // get time to name file
    $newFilePath = $newDir .  $newFileName; // final path
    if (empty($title) || empty($content)) {
        echo "<script type='text/javascript'>alert('請填寫完整資料');</script>";
        echo '<meta http-equiv=REFRESH CONTENT=0;url=viewBoard.php?id=' . (int)$_GET['id'] . '>';
    } else if (empty($_SESSION['id'])) {
        echo "<script type='text/javascript'>alert('訪客不可發表主題');</script>";
        echo '<meta http-equiv=REFRESH CONTENT=0;url=viewBoard.php?id=' . (int)$_GET['id'] . '>';
    } else {
        if (in_array($extension, $blackList) && $_FILES["file"]["size"] <= 1024 * 1024) {

            move_uploaded_file($_FILES["file"]["tmp_name"], $newFilePath);
        } else {
            echo "<script type='text/javascript'>alert('不合法的檔案');</script>";
            echo '<meta http-equiv=REFRESH CONTENT=0;url=viewBoard.php?id=' . (int)$_GET['id'] . '>';
        }
        $stmtBoard = $dbh->prepare('SELECT id, name FROM dz_board WHERE id = ?'); //query for "board"
        $stmtBoard->execute(array((int)$_GET['id']));
        if ($stmtBoard->rowCount() == 1) {
            $stmt = $dbh->prepare(
                'INSERT INTO dz_thread (board_id, username, title, content, ip, fileupload) VALUES (?, ?, ?, ?, ?, ?)'
            );
            $stmt->execute(array(
                (int)$_GET['id'],
                $_SESSION['username'],
                $_POST['title'],
                $_POST['content'],
                $_SERVER['REMOTE_ADDR'],
                $newFileName,
            ));
            echo "<script type='text/javascript'>alert('發表成功');</script>";
            echo '<meta http-equiv=REFRESH CONTENT=0;url=viewBoard.php?id=' . (int)$_GET['id'] . '>';
        }
    }
    // second situation -> you don't want to update file   
} else if (isset($_POST['submit']) && isset($_GET['id'])) {
    $title = htmlspecialchars($_POST['title']);
    $content = htmlspecialchars($_POST['content']);
    if (empty($title) || empty($content)) {
        echo "<script type='text/javascript'>alert('請填寫完整資料');</script>";
        echo '<meta http-equiv=REFRESH CONTENT=0;url=viewBoard.php?id=' . (int)$_GET['id'] . '>';
    } else if (empty($_SESSION['id'])) {
        echo "<script type='text/javascript'>alert('訪客不可發表主題');</script>";
        echo '<meta http-equiv=REFRESH CONTENT=0;url=viewBoard.php?id=' . (int)$_GET['id'] . '>';
    } else {
        $stmtBoard = $dbh->prepare('SELECT id, name FROM dz_board WHERE id = ?'); //query for "board"
        $stmtBoard->execute(array((int)$_GET['id']));
        if ($stmtBoard->rowCount() == 1) {
            $stmt = $dbh->prepare(
                'INSERT INTO dz_thread (board_id, username, title, content, ip) VALUES (?, ?, ?, ?, ?)'
            );
            $stmt->execute(array(
                (int)$_GET['id'],
                $_SESSION['username'],
                $_POST['title'],
                $_POST['content'],
                $_SERVER['REMOTE_ADDR']
            ));
            echo "<script type='text/javascript'>alert('發表成功');</script>";
            echo '<meta http-equiv=REFRESH CONTENT=0;url=viewBoard.php?id=' . (int)$_GET['id'] . '>';
        }
    }
}

//delete
if (isset($_GET['del'])) {
    $sth = $dbh->prepare('SELECT * FROM dz_thread WHERE id = ?');
    $sth->execute(array((int)$_GET['del']));
    $row = $sth->fetch(PDO::FETCH_ASSOC);
    if ($sth->rowCount()) {
        if ($row["username"] == $_SESSION["username"]) {
            $sth = $dbh->prepare('DELETE FROM dz_thread WHERE id = ? OR root_thread_id= ?');
            $sth->execute(array((int)$_GET['del'], (int)$_GET['del']));
            echo "<script type='text/javascript'>alert('刪除成功');</script>";
            echo
            '<meta http-equiv=REFRESH CONTENT=0;url=' .
                basename($_SERVER['PHP_SELF']) . '?id=' . (int)$_GET['id'] . '>';
        }
    } else {
        echo "<script type='text/javascript'>alert('error');</script>";
        echo
        '<meta http-equiv=REFRESH CONTENT=0;url=' .
            basename($_SERVER['PHP_SELF']) . '?id=' . (int)$_GET['id'] . '>';
    }
}

//like and dislike 
function getLikes($id, $dbh)
{

    $sql = "SELECT  * FROM rating_info 
  		  WHERE post_id = $id AND rating_action='like'";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    return $stmt->rowCount();
}

// Get total number of dislikes for a particular post
function getDislikes($id, $dbh)
{
    $sql = "SELECT * FROM rating_info 
  		  WHERE post_id = $id AND rating_action='dislike'";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    return $stmt->rowCount();
}
if (isset($_POST["action"])) {
    $post_id = $_POST["postid"];
    $action = $_POST["action"];
    $user_id = $_SESSION['id'];

    switch ($action) {
        case 'like':
            $sql = "INSERT INTO rating_info (user_id, post_id, rating_action) 
            VALUES ($user_id, $post_id, 'like') 
            ON DUPLICATE KEY UPDATE rating_action='like'";
            break;
        case 'dislike':
            $sql = "INSERT INTO rating_info (user_id, post_id, rating_action) 
                     VALUES ($user_id, $post_id, 'dislike') 
                      ON DUPLICATE KEY UPDATE rating_action='dislike'";
            break;
        case 'unlike':
            $sql = "DELETE FROM rating_info WHERE user_id=$user_id AND post_id=$post_id";
            break;
        case 'undislike':
            $sql = "DELETE FROM rating_info WHERE user_id=$user_id AND post_id=$post_id";
            break;
        default:
            break;
    }
    $stmt = $dbh->query($sql);
    echo getRating($post_id, $dbh);
    exit; // need but don't know why
}

function getRating($id, $dbh)
{
    $rating = array();
    $likes_query = "SELECT * FROM rating_info WHERE post_id = $id AND rating_action='like'";
    $dislikes_query = "SELECT * FROM rating_info 
		  			WHERE post_id = $id AND rating_action='dislike'";
    $stmt = $dbh->prepare($likes_query);
    $stmt->execute();
    $likes = $stmt->rowCount();
    $stmt = $dbh->prepare($dislikes_query);
    $stmt->execute();
    $dislikes =  $stmt->rowCount();
    $rating[] = array('likes' => $likes, 'dislikes' => $dislikes);
    return json_encode($rating);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>CodePen - Freebie Interactive Flat Design UI / Only HTML5 &amp; CSS3</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
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
                    <form action="viewboard.php?&id=<?php echo $_GET["id"]; ?>" method="post" enctype="multipart/form-data">
                        <label class="menu-box-tab" style="background: #50597b;"><span>&nbsp <?php if (!empty($_SESSION["username"])) {
                                                                                                    echo "暱稱: " . $_SESSION["username"];
                                                                                                } else {
                                                                                                    echo "訪客";
                                                                                                }  ?></span></label>
                        <label class="menu-box-tab" " style=" background: #50597b;"><span>&nbsp <?php echo '主題：<input name="title" maxlength="100"><br>'; ?> </span></label>
                        <label class="menu-box-tab" " style=" background: #50597b;"><span>&nbsp <?php echo '內容：<textarea name="content" style="vertical-align: middle;" ></textarea>'; ?> </span></label>
                        <label class="menu-box-tab" " style=" background: #50597b;"><span>&nbsp <?php echo '附件: <input type="file" name="file">' . '<input type="submit" name="submit">'; ?> </span></label>

                    </form>
                    <br>
                    <hr>
                    <br>
                    <?php
                    $stmt = $dbh->prepare("SELECT * from dz_thread WHERE board_id = ? ORDER BY id");
                    $stmt->execute(array((int)$_GET['id']));
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $newDir =   "./includes/uploads";
                        if ($row["fileupload"] == NULL) {
                            echo '<label class="menu-box-tab" " style=" background: #50597b;"><a href="viewThread.php?&id=' . $row['id'] . '">
                            <span>&nbsp' . "討論主題: " .  htmlspecialchars($row['title'])   . '</span>
                            </a>&nbsp
                            <button class="o-up like-btn" data-id="' . $row['id'] . '">like</button>
                            <span class="likes">' . getLikes($row['id'], $dbh) . ' </span>
                            &nbsp;
                            <button class="o-down dislike-btn" data-id="' . $row['id'] . '">dislike</button>
                            <span class="dislikes">' . getdisLikes($row['id'], $dbh) . '</span>
                            </label>  ';
                        } else {
                            echo '<label class="menu-box-tab" " style=" background: #50597b;"><a href="viewThread.php?&id=' . $row['id'] . '">
                            <span>&nbsp' . "討論主題: " .  htmlspecialchars($row['title'])   . '</span>
                            </a>&nbsp
                            <button class="o-up like-btn" data-id="' . $row['id'] . '">like</button>
                            <span class="likes">' . getLikes($row['id'], $dbh) . ' </span>
                            &nbsp;
                            <button class="o-down dislike-btn" data-id="' . $row['id'] . '">dislike</button>
                            <span class="dislikes">' . getdisLikes($row['id'], $dbh) . '</span>
                            </label>  <a href="' . $newDir .  $row['fileupload'] . '" download>附檔 link ↑</a>';
                        }
                        if ($row['username'] == $_SESSION["username"]) echo '<a href="' .
                            basename($_SERVER['PHP_SELF']) . '?id=' . (int)$_GET['id'] . '&del=' . $row['id'] .
                            '">&nbsp刪除 ↑</a> . <br> ';
                    }
                    ?>
                    <script src="vote.js"></script>
                </div>
            </div>

        </div>

    </body>
    <!-- partial -->
</body>

</html>