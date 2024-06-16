<?php
if (session_status() == PHP_SESSION_NONE) session_start();

require_once '../../Model/DBconection.php';
$conn = DBconection::connectDB();

header('Content-Type: application/json');
$response = [];

$groupId = $_POST['groupId'];
$groupName = $_POST['groupNewName'];

$stmt = $conn->prepare("UPDATE `chanelsgroup` SET `name` = :newName WHERE `id` = :groupId");
$stmt->bindParam(":newName", $groupName);
$stmt->bindParam(":groupId", $groupId);

if ($stmt->execute()) {
    $response['success'] = true;

    if (isset($_SESSION['groups'])) {
        foreach ($_SESSION['groups'] as &$group) {
            if ($group['id'] == $groupId) {
                $group['name'] = $groupName;
                break;
            }
        }
    }
} else {
    $response['error'] = "Something went wrong";
}

echo json_encode($response);
