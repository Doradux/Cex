<?php
if (session_status() == PHP_SESSION_NONE) session_start();

include_once "../../Model/User.php";
require_once '../../Model/DBconection.php';
$conn = DBconection::connectDB();

$serverId = $_POST['serverId'];
$userId = $_SESSION['currentUser']['id'];

$addServer = "INSERT INTO `user-server` (`userId`, `serverId`) VALUES (:userId, :serverId)";
$userServers = "SELECT * FROM `user-server` WHERE `userId` = :userId";
$serverExists = "SELECT * FROM `servers`";

function validServer($conn, $serverId, $serverExists)
{
    $stmt = $conn->query($serverExists);
    $allServers = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($allServers as $server) {
        if ($server['id'] == $serverId) {
            return true;
        }
    }
    return false;
}

function userNotInJet($conn, $serverId, $userServers, $userId)
{
    $stmt = $conn->prepare($userServers);
    $stmt->execute([':userId' => $userId]);
    $uServers = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($uServers as $join) {
        if ($join['serverId'] == $serverId) {
            return false;
        }
    }
    return true;
}

if (validServer($conn, $serverId, $serverExists) && userNotInJet($conn, $serverId, $userServers, $userId)) {
    $stmt = $conn->prepare($addServer);
    if ($stmt->execute([':userId' => $userId, ':serverId' => $serverId])) {
        $response['status'] = 'success';
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Error: couldn\'t join to the server';
    }
} else {
    $response['status'] = 'error';
    if (!validServer($conn, $serverId, $serverExists) && !userNotInJet($conn, $serverId, $userServers, $userId)) {
        $response['message'] = 'Error: both conditions fail';
    } elseif (!validServer($conn, $serverId, $serverExists)) {
        $response['message'] = 'Error: not valid server';
    } elseif (!userNotInJet($conn, $serverId, $userServers, $userId)) {
        $response['message'] = 'Error: already on server';
    } else {
        $response['message'] = 'Error: uncaught error';
    }
}

echo json_encode($response);
