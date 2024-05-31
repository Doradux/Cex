<?php
if (session_status() == PHP_SESSION_NONE) session_start();

include_once "./Model/User.php";
require_once './Model/DBconection.php';
$conn = DBconection::connectDB();

// Obtén los IDs de los servidores vinculados al usuario
$sql = "SELECT serverId FROM `user-server` WHERE userId = :userId";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':userId', $_SESSION["currentUser"]["id"], PDO::PARAM_INT);
$stmt->execute();
$joinedServersId = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

// Obtén los servidores donde el usuario se ha unido por serverId, incluyendo el nombre de la imagen
$servers = [];
if (!empty($joinedServersId)) {
    $placeholders = str_repeat('?,', count($joinedServersId) - 1) . '?';
    $sql = "
        SELECT s.*, si.name AS serverImg 
        FROM servers s 
        JOIN `server-image` si ON s.imageId = si.id 
        WHERE s.id IN ($placeholders)
    ";
    $stmt = $conn->prepare($sql);
    $stmt->execute($joinedServersId);
    $servers = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

include './views/main_app.php';
?>
