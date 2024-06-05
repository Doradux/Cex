<?php
if (session_status() == PHP_SESSION_NONE) session_start();

require_once '../../Model/DBconection.php';
$conn = DBconection::connectDB();

$chanelName = $_POST['name'];
$chanelDescription = $_POST['description'];
$chanelType = $_POST['type'];
if ($chanelType == 0) {
    $chanelType = 'chat';
} else {
    $chanelType = 'voice';
}
$groupId = $_POST['groupId'];

$sql = "INSERT INTO `chanels` (`name`, `groupId`, `type`, `description`) VALUES ('$chanelName', '$groupId', '$chanelType', '$chanelDescription')";
$conn->query($sql);
