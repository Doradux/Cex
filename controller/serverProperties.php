<?php
if (session_status() == PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['currentUser']['username'])) {
    header('Location: .');
}

require_once '../Model/DBconection.php';
$conn = DBconection::connectDB();

function getServerImageNameById($serverId, $conn)
{
    $sql = "
        SELECT si.name AS serverImg 
        FROM servers s 
        JOIN `server-image` si ON s.imageId = si.id 
        WHERE s.id = ?
    ";

    $stmt = $conn->prepare($sql);
    $stmt->execute([$serverId]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        return $result['serverImg'];
    } else {
        return null;
    }
}
$serverImg = getServerImageNameById($_SESSION['currentServer']['id'], $conn);



include '../views/serverProperties.php';
