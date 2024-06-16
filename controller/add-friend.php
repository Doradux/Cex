<?php
if (session_status() == PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['currentUser']['username'])) {
    header('Location: .');
}

require_once '../Model/DBconection.php';
$conn = DBconection::connectDB();

//get sent requests
$sent = [];

$sql = "SELECT `user2` FROM `pending` WHERE `user1` = :currentId";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":currentId", $_SESSION['currentUser']['id']);
if ($stmt->execute()) {
    $sent = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
}

$sentUsersData = [];
if (!empty($sent)) {
    //get usersInfo and image
    $placeholders = implode(',', array_fill(0, count($sent), '?'));
    $sql = "SELECT `id`, `username`, `displayname`, `imageId` FROM `users` WHERE `id` IN ($placeholders)";
    $stmt = $conn->prepare($sql);
    foreach ($sent as $k => $id) {
        $stmt->bindValue(($k + 1), $id, PDO::PARAM_INT);
    }
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($users as $user) {
        if ($user['imageId']) {
            $sql = 'SELECT `name` FROM `user-image` WHERE `id` = :imageId';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':imageId', $user['imageId']);
            $stmt->execute();
            $image = $stmt->fetch(PDO::FETCH_ASSOC);

            $user['image'] = $image ? $image['name'] : 'default.png';
        } else {
            $user['image'] = 'default.png';
        }
        $sentUsersData[] = $user;
    }
}

include '../views/add-friend.php';
