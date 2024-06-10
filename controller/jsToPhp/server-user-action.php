<?php
if (session_status() == PHP_SESSION_NONE) session_start();

require_once '../../Model/DBconection.php';
$conn = DBconection::connectDB();

header('Content-Type: application/json');

$response = [];

//changeNick
if (isset($_POST['nick'])) {
    $newNick = $_POST['nick'];
    $id = $_POST['id'];

    $sql = "UPDATE `user-server` SET `serverNick` = :newNick WHERE `userId` = :userId AND `serverId` = :serverId";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":newNick", $newNick);
    $stmt->bindParam(":userId", $id);
    $stmt->bindParam(":serverId", $_SESSION['currentServer']['id']);
    if ($stmt->execute()) {
        //refresh user nick in session
        for ($i = 0; $i < count($_SESSION['serverUsers']); $i++) {
            if ($_SESSION['serverUsers'][$i]['id'] == $id) {
                $_SESSION['serverUsers'][$i]['serverNick'] = $newNick;
                $_SESSION['serverUsers'][$i]['name'] = $newNick;
            }
        }

        $response['success'] = true;
    } else {
        $response['error'] = "User Nick couldn't be changed";
    }
}

//change user role
if (isset($_POST['rId'])) {
    $rId = $_POST['rId'];
    $rServerId = $_SESSION['currentServer']['id'];
    if ($_POST['currentRole'] == "admin") {
        $sql = "UPDATE `user-server` SET `role` = 'user' WHERE `userId` = :userId AND `serverId` = :serverId";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":userId", $rId);
        $stmt->bindParam(":serverId", $rServerId);
        if ($stmt->execute()) {
            //refresh user nick in session
            for ($i = 0; $i < count($_SESSION['serverUsers']); $i++) {
                if ($_SESSION['serverUsers'][$i]['id'] == $rId) {
                    $_SESSION['serverUsers'][$i]['serverRole'] = "user";
                }
            }

            $response['success'] = true;
        }
    } else {
        $response['error'] = "User role couldn't be changed";
    }

    if ($_POST['currentRole'] == "user") {
        $sql = "UPDATE `user-server` SET `role` = 'admin' WHERE `userId` = :userId AND `serverId` = :serverId";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":userId", $rId);
        $stmt->bindParam(":serverId", $rServerId);
        if ($stmt->execute()) {
            //refresh user role in session
            for ($i = 0; $i < count($_SESSION['serverUsers']); $i++) {
                if ($_SESSION['serverUsers'][$i]['id'] == $rId) {
                    $_SESSION['serverUsers'][$i]['serverRole'] = "admin";
                }
            }

            $response['success'] = true;
        }
    } else {
        $response['error'] = "User role couldn't be changed";
    }
}


//kick member
if (isset($_POST['kickId'])) {
    $kickId = $_POST['kickId'];
    $response['kickId'] = $kickId;
    $sql = "DELETE FROM `user-server` WHERE `userId` = :userId AND `serverId` = :serverId";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":userId", $kickId);
    $stmt->bindParam(":serverId", $_SESSION['currentServer']['id']);
    if ($stmt->execute()) {
        foreach ($_SESSION['serverUsers'] as $user) {
            if ($user['id'] == 1) {
                unset($_SESSION[$user]);
            }
        }

        $response['success'] = true;
    } else {
        $response['error'] = "User couldn't be deleted";
    }
}




echo json_encode($response);
