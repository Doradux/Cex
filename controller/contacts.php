<?php
if (session_status() == PHP_SESSION_NONE) session_start();

require_once '../Model/DBconection.php';
$conn = DBconection::connectDB();

$_SESSION['friends'] = [];
$friends = [];
$friendsIds = [];

//get friends
$sql = "SELECT `user2` FROM `friendships` WHERE `user1` = :userId";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":userId", $_SESSION['currentUser']['id']);
if ($stmt->execute()) {
    $friendsIds = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (!empty($friendsIds)) {
        $friendsIdsList = implode(',', array_map('intval', $friendsIds));
        $sql = "SELECT * FROM `users` WHERE `id` IN ($friendsIdsList)";
        $stmt = $conn->prepare($sql);

        if ($stmt->execute()) {
            $friends = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $_SESSION['friends'] = $friends;
        } else {
            $response['error'] = "Error fetching friends data.";
        }
    }
} else {
    $response['error'] = "Error fetching friends IDs";
}


include '../views/contacts.php';
