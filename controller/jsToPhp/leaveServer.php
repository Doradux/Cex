<?php
if (session_status() == PHP_SESSION_NONE) session_start();

require_once '../../Model/DBconection.php';
$conn = DBconection::connectDB();

$sql = 'DELETE FROM `user-server` where `userId` = :userId AND `serverId` = :serverId';
$stmt = $conn->prepare($sql);
$stmt->bindParam(':userId', $_SESSION['currentUser']['id']);
$stmt->bindParam(':serverId', $_SESSION['currentServer']['id']);

if ($stmt->execute()) {
    $response['success'] = true;
} else {
    $response['error'] = 'Failed to leave server';
}

echo json_encode($response);
