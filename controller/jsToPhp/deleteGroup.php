<?php
if (session_status() == PHP_SESSION_NONE) session_start();

require_once '../../Model/DBconection.php';
$conn = DBconection::connectDB();
header('Content-Type: application/json');

$response = [];

if (isset($_POST['groupId'])) {
    $groupId = $_POST['groupId'];

    // Get chanels
    $stmt = $conn->prepare("SELECT * FROM `chanels` WHERE `groupId` = :groupId");
    $stmt->bindParam(":groupId", $groupId);
    if ($stmt->execute()) {
        $chanels = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($chanels as $chanel) {
            // Delete messages
            $sql = "DELETE FROM `messages` WHERE chanelId = :chanelId";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":chanelId", $chanel['id']);
            if (!$stmt->execute()) {
                $response['error'] = "Couldn't delete messages for chanelId: " . $chanel['id'];
                echo json_encode($response);
                exit();
            }

            // Delete chanel
            $sql = "DELETE FROM `chanels` WHERE id = :chanelId";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":chanelId", $chanel['id']);
            if (!$stmt->execute()) {
                $response['error'] = "Couldn't delete chanel with id: " . $chanel['id'];
                echo json_encode($response);
                exit();
            }
        }

        // Delete group
        $stmt = $conn->prepare("DELETE FROM `chanelsgroup` WHERE `id` = :groupId");
        $stmt->bindParam(":groupId", $groupId);
        if ($stmt->execute()) {
            $response['success'] = true;
        } else {
            $response['error'] = "Couldn't delete group with id: " . $groupId;
        }
    } else {
        $response['error'] = "Couldn't get chanels for groupId: " . $groupId;
    }
} else {
    $response['error'] = "groupId not set in POST request";
}

echo json_encode($response);
