<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../Model/DBconection.php';
$conn = DBconection::connectDB();

// get chanel id and data
$chanelId = $_GET['chanelId'];
$sql = 'SELECT * FROM `chanels` WHERE id = :chanelId';
$stmt = $conn->prepare($sql);
$stmt->bindParam(":chanelId", $chanelId);
$stmt->execute();
$chanelData = $stmt->fetch(PDO::FETCH_ASSOC);

// get msgs
$sqlMsgs = 'SELECT * FROM `messages` WHERE chanelId = :chanelId';
$stmtMsgs = $conn->prepare($sqlMsgs);
$stmtMsgs->bindParam(":chanelId", $chanelId);
$stmtMsgs->execute();
$_SESSION['msgs'] = $stmtMsgs->fetchAll(PDO::FETCH_ASSOC);

// get friend data
$friendId = $_GET['userId'];
$sqlFriend = "SELECT `id`, `username`, `displayname`, `imageId` FROM `users` WHERE `id` = :userId";
$stmtFriend = $conn->prepare($sqlFriend);
$stmtFriend->bindParam(":userId", $friendId);

if ($stmtFriend->execute()) {
    $friendData = $stmtFriend->fetch(PDO::FETCH_ASSOC);

    $sqlImage = 'SELECT `name` FROM `user-image` WHERE id = :imageId';
    $stmtImage = $conn->prepare($sqlImage);
    $stmtImage->bindParam(":imageId", $friendData['imageId']);
    if ($stmtImage->execute()) {
        $friendImg = $stmtImage->fetch(PDO::FETCH_ASSOC);
        $friendData['image'] = $friendImg['name'];
    } else {
        $friendData['image'] = "default.jpg";
    }

    if (!empty($friendData['displayname'])) {
        $friendData['name'] = $friendData['displayname'];
    } else {
        $friendData['name'] = $friendData['username'];
    }
} else {
    $friendData = array(
        'id' => 0,
        'username' => '(Error fetching user)',
        'displayname' => '',
        'imageId' => 0,
        'image' => 'default.jpg'
    );
}


// Incluir la vista correspondiente
include '../views/private-text-chanel.php';
