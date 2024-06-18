<?php
if (session_status() == PHP_SESSION_NONE) session_start();

require_once '../../Model/DBconection.php';
$conn = DBconection::connectDB();
header('Content-Type: application/json');

$response = array();

if (isset($_POST['userId'])) {
    $userId = $_POST['userId'];

    $stmt = $conn->prepare("DELETE FROM `pending` WHERE `user1` = :currentId AND `user2` = :userId");
    $stmt->bindParam(":currentId", $_SESSION['currentUser']['id']);
    $stmt->bindParam(":userId", $userId);
    if ($stmt->execute()) {
        $response['success'] = true;
    } else {
        $response['error'] = "Error deleting friend request";
    }
} else {
    $response['error'] = "No userId submited";
}

echo json_encode($response);
