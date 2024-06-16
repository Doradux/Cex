<?php
if (session_status() == PHP_SESSION_NONE) session_start();

require_once 'DBconection.php';
$conn = DBconection::connectDB();

if (isset($_POST['create'])) {
    $name = $_POST['name'];
    $creationTime = $_POST['creationTime'];
    $userId = $_SESSION['currentUser']['id'];

    function generateRandomCode($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomCode = '';

        for ($i = 0; $i < $length; $i++) {
            $randomCode .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomCode;
    }

    $dinamicId = generateRandomCode();

    $sql = "INSERT INTO `servers` (`name`, `creationTime`, `imageId`, `grandImageId`, `privacity`, `ownerId`, `dinamicId`) VALUES ('$name', '$creationTime', '1', '1', 'private', '$userId', '$dinamicId')";
    $conn->query($sql);
    $serverId = $conn->lastInsertId();

    $sql = "INSERT INTO `chanelsgroup` (`name`, `serverId`) VALUES ('Default group', $serverId)";
    $conn->query($sql);
    $groupId = $conn->lastInsertId();

    $sql = "INSERT INTO `chanels` (`name`, `groupId`, `type`, `description`) VALUES ('Default chanel', $groupId, 'chat', 'This is a chatting chanel')";
    $conn->query($sql);

    $sql = "INSERT INTO `user-server` (`userId`, `serverId`, `role`) VALUES (" . $_SESSION['currentUser']['id'] . ", " . $serverId . ", 'admin')";
    $conn->query($sql);
}
