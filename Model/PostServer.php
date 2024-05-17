<?php
if (session_status() == PHP_SESSION_NONE) session_start();

require_once 'DBconection.php';
$conn = DBconection::connectDB();

if (isset($_POST['create'])) {
    $name = $_POST['name'];
    $creationTime = $_POST['creationTime'];

    $sql = "INSERT INTO `servers` (`name`, `creationTime`, `image`, `grandImage`) VALUES ('$name', '$creationTime', 'default', 'default')";
    $conn->query($sql);
    $serverId = $conn->lastInsertId();
    
    $sql = "INSERT INTO `chanelsgroup` (`name`, `serverId`) VALUES ('Default group', $serverId)";
    $conn->query($sql);
    $groupId = $conn->lastInsertId();

    $sql = "INSERT INTO `chanels` (`name`, `groupId`, `type`) VALUES ('Default chanel', $groupId, 'chat')";
    $conn->query($sql);

    $sql = "INSERT INTO `user-server` (`userId`, `serverId`, `role`) VALUES (" . $_SESSION['currentUser']['id'] . ", " . $serverId . ", 'admin')";
    $conn->query($sql);
}
