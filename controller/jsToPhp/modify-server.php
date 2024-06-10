<?php
if (session_status() == PHP_SESSION_NONE) session_start();

require_once '../../Model/DBconection.php';
$conn = DBconection::connectDB();

$response = [];

if (isset($_POST['newServerName'])) {
    $newName = $_POST['newServerName'];
    $sql = "UPDATE `servers` SET `name` = :newName WHERE `id` = :serverId";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":newName", $newName);
    $stmt->bindParam(":serverId", $_SESSION['currentServer']['id']);

    if ($stmt->execute()) {
        $response['success'] = true;
        $_SESSION['currentServer']['name'] = $newName;
    } else {
        $response['error'] = "Server name coulnd't be updated";
    }
}

if (isset($_POST['chanelId'])) {
    $chanelId = $_POST['chanelId'];
    $chanelName = $_POST['chanelName'];
    $sql = "UPDATE `servers` SET `welcomeChanel` = :newChanel WHERE `id` = :serverId";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":newChanel", $chanelId);
    $stmt->bindParam(":serverId", $_SESSION['currentServer']['id']);

    if ($stmt->execute()) {
        $response['success'] = true;
        $_SESSION['currentServer']['welcomeChanel'] = $chanelName;
    } else {
        $response['error'] = "Server name coulnd't be updated";
    }
}

echo json_encode($response);
