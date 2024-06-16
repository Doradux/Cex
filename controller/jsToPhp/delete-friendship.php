<?php
if (session_status() == PHP_SESSION_NONE) session_start();

require_once '../../Model/DBconection.php';
$conn = DBconection::connectDB();
header('Content-Type: application/json');

$response = [];

$userId = $_POST['userId'];
$myId = $_SESSION['currentUser']['id'];
$stmt = $conn->prepare("DELETE FROM `friendships` WHERE (`user1` = :user1 AND `user2` = :user2) OR (`user1` = :user2 AND `user2` = :user1)");
$stmt->bindParam(":user1", $myId);
$stmt->bindParam(":user2", $userId);
if ($stmt->execute()) {
    $response['success'] = true;
} else {
    $response['error'] = "Error removing friendship";
}


echo json_encode($response);
