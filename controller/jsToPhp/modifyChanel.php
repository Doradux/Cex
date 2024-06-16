<?php
if (session_status() == PHP_SESSION_NONE) session_start();

require_once '../../Model/DBconection.php';
$conn = DBconection::connectDB();

header('Content-Type: application/json');
$response = [];

$chanelId = $_POST['chanelId'];
$chanelName = $_POST['chanelNewName'];

$stmt = $conn->prepare("UPDATE `chanels` SET `name` = :newName WHERE `id` = :chanelId");
$stmt->bindParam(":newName", $chanelName);
$stmt->bindParam(":chanelId", $chanelId);

if ($stmt->execute()) {
    $response['success'] = true;
} else {
    $response['Error'] = "Something went wrong";
}

echo json_encode($response);
