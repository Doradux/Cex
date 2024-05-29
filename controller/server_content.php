<?php
if (session_status() == PHP_SESSION_NONE) session_start();

require_once '../Model/DBconection.php';
include_once "../Model/User.php";

$conn = DBconection::connectDB();

// Obtener la información del servidor junto con el nombre de la imagen grandImage
$sql = "
    SELECT s.*, sg.name AS grandImageName 
    FROM `servers` s
    LEFT JOIN `server-grandImage` sg ON s.grandImageId = sg.id
    WHERE s.id = :serId
";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':serId', $_GET['serId'], PDO::PARAM_INT);
$stmt->execute();
$currentServer = $stmt->fetch(PDO::FETCH_ASSOC);

// Determinar la imagen a usar
if ($currentServer['grandImageName'] == 'default') {
    $grandImage = 'default.jpg';
} else {
    $grandImage = $currentServer['grandImageName'];
}

// Obtener los grupos de canales del servidor
$chanelsGroups = [];
$sql = "SELECT * FROM `chanelsgroup` WHERE serverId = :serId";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':serId', $_GET['serId'], PDO::PARAM_INT);
$stmt->execute();
while ($group = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $chanelsGroups[] = $group;
}

// Obtener el rol del usuario
$sql = "SELECT role FROM `user-server` WHERE userId = :userId AND serverId = :serverId";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':userId', $_SESSION['currentUser']['id'], PDO::PARAM_INT);
$stmt->bindParam(':serverId', $currentServer['id'], PDO::PARAM_INT);
$stmt->execute();
$role = $stmt->fetch(PDO::FETCH_ASSOC)['role'];

include '../views/server_content.php';
?>
