<?php
if (session_status() == PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['currentUser']['username'])) {
    header('Location: .');
}

require_once '../Model/DBconection.php';
$conn = DBconection::connectDB();

$chanelId = $_GET['chanelId'];
$sql = 'SELECT * FROM `chanels` WHERE id = ' . $chanelId;
$stmt = $conn->query($sql);
$chanelData = $stmt->fetch(PDO::FETCH_ASSOC);

//get chanel msgs
$sql = 'SELECT * FROM `messages` WHERE chanelId = ' . $chanelId;
$stmt = $conn->query($sql);
$_SESSION['msgs'] = $stmt->fetchAll(PDO::FETCH_ASSOC);


if ($chanelData['type'] == "chat") {
    include '../views/text_chanel.php';
} else {
    header("Location: ../videocalls/videocall.php?chanelId=" . $chanelData['id']);
}
