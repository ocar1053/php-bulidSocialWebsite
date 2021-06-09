<?php
session_start();
include('includes/pdoInc.php');

//check room exist room or not
$params = base64_decode($_GET['id']);
$send = (int)$params;
$sql = "SELECT * FROM chatroomlist WHERE roomid= ?";
$stmt = $dbh->prepare($sql);
$stmt->execute(array((int)$params));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$row) header("Location:..//message.php?&id=" . $_SESSION['id']);

?>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <style>
        table,
        tr,


        table {
            width: 100%;
            height: 100%;
        }

        #showMsgHere {
            width: 100%;
            height: 100%;
            font-size: 20px;
            resize: none;
        }

        form {
            display: flex
        }

        input {
            font-size: 1.2em;
            padding: 10px;
            margin: 10px, 5px;
            appearance: none;
            -webkit-appearance: none;
            border: 1px solid #ccc;
            border: radius 5px;
        }

        #msg {
            flex: 2
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="chat.js"></script>
</head>

<body bgcolor="#606468">
    <table>
        <tr height="90%">
            <td><textarea id="showMsgHere" disabled="disabled"></textarea></td>
        </tr>
        <tr>
            <td>
                <input type="hidden" id="page" value="<?php echo $_GET['id']; ?>">
                <form>

                    <input type="text" id="nickname" value="<?php echo $_SESSION['username'] ?>" disabled="disabled" style="width:5em;height:2em">
                    <input type="text" id="msg" placeholder="Type message..." style="width:70em;height:2em">
                    <input type="button" value="send" onclick="sendMsg();" style="padding: 5px 24px;">
                </form>
            </td>
        </tr>
    </table>

</body>

</html>