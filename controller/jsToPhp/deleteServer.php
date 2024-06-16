<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../../Model/DBconection.php';
$conn = DBconection::connectDB();
header('Content-Type: application/json');

$response = [];

if (isset($_SESSION['currentServer'])) {
    $serverId = $_SESSION['currentServer']['id'];

    // delete channels from all groups
    $sql = "SELECT cg.id AS groupId FROM `chanelsgroup` cg WHERE cg.serverId = :serverId";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":serverId", $serverId);
    if ($stmt->execute()) {
        $groups = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($groups as $group) {
            $groupId = $group['groupId'];

            // delete channels
            $sqlDeleteChannels = "DELETE FROM `chanels` WHERE `groupId` = :groupId";
            $stmtDeleteChannels = $conn->prepare($sqlDeleteChannels);
            $stmtDeleteChannels->bindParam(":groupId", $groupId);
            if (!$stmtDeleteChannels->execute()) {
                $response['error'] = "Couldn't delete channels for groupId: " . $groupId;
                echo json_encode($response);
                exit();
            }

            // delete group
            $sqlDeleteGroup = "DELETE FROM `chanelsgroup` WHERE `id` = :groupId";
            $stmtDeleteGroup = $conn->prepare($sqlDeleteGroup);
            $stmtDeleteGroup->bindParam(":groupId", $groupId);
            if (!$stmtDeleteGroup->execute()) {
                $response['error'] = "Couldn't delete group with id: " . $groupId;
                echo json_encode($response);
                exit();
            }
        }
    } else {
        $response['error'] = "Couldn't get groups for serverId: " . $serverId;
        echo json_encode($response);
        exit();
    }

    // delete user-server relations
    $sqlDeleteUserServer = "DELETE FROM `user-server` WHERE `serverId` = :serverId";
    $stmtDeleteUserServer = $conn->prepare($sqlDeleteUserServer);
    $stmtDeleteUserServer->bindParam(":serverId", $serverId);
    if (!$stmtDeleteUserServer->execute()) {
        $response['error'] = "Couldn't delete user-server relations for serverId: " . $serverId;
        echo json_encode($response);
        exit();
    }

    // delete server
    $sqlDeleteServer = "DELETE FROM `servers` WHERE `id` = :serverId";
    $stmtDeleteServer = $conn->prepare($sqlDeleteServer);
    $stmtDeleteServer->bindParam(":serverId", $serverId);
    if ($stmtDeleteServer->execute()) {
        $response['success'] = true;
    } else {
        $response['error'] = "Couldn't delete server with id: " . $serverId;
    }
} else {
    $response['error'] = "Server id is not defined";
}

echo json_encode($response);
