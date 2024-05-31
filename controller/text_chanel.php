<?php
if (session_status() == PHP_SESSION_NONE) session_start();

require_once '../Model/DBconection.php';
$conn = DBconection::connectDB();

$chanelId = $_GET['chanelId'];
$sql = 'SELECT * FROM `chanels` WHERE id = ' . $chanelId;
$stmt = $conn->query($sql);
$chanelData = $stmt->fetch(PDO::FETCH_ASSOC);

//get chanel msgs
$sql = 'SELECT * FROM `messages` WHERE chanelId = ' . $chanelId;
$stmt = $conn->query($sql);
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);


include '../views/text_chanel.php';