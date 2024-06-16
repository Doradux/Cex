<?php
if (session_status() == PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['currentUser']['username'])) {
        header('Location: .');
    }

require_once '../Model/DBconection.php';
include_once "../Model/User.php";

$conn = DBconection::connectDB();

$_GET['page'];

//get servers
$sql = "SELECT s.*, 
               si.name AS imageName, 
               sgi.name AS grandImageName
        FROM `servers` s
        LEFT JOIN `server-image` si ON s.imageId = si.id
        LEFT JOIN `server-grandImage` sgi ON s.grandimageId = sgi.id
        WHERE s.privacity = 'public'";


$stmt = $conn->prepare($sql);
$stmt->execute();
$servers = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM `user-server` WHERE `serverId` = :serverId";
$stmt = $conn->prepare($sql);



include '../views/public-servers.php';
