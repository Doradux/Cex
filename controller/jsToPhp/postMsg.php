<?php
if (session_status() == PHP_SESSION_NONE) session_start();

require_once '../../Model/DBconection.php';
$conn = DBconection::connectDB();

$message = $_POST['message'];
$chanelId = $_POST['chanelId'];
$userId = $_SESSION['currentUser']['id'];

$sql = "INSERT INTO `messages` (`content`, `userId`, `chanelId`) VALUES ('$message', '$userId', '$chanelId')";
$conn->query($sql);
