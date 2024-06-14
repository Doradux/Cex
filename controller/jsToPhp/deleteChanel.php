<?php
if (session_status() == PHP_SESSION_NONE) session_start();

require_once '../../Model/DBconection.php';
$conn = DBconection::connectDB();
header('Content-Type: application/json');

$response = [];

if (isset($_POST['chanelId'])) {
    $chanelId = $_POST['chanelId'];
    //delete msgs
    $sql = "DELETE FROM `messages` WHERE chanelId = :chanelId";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":chanelId", $chanelId);

    if ($stmt->execute()) {
        $sql = "DELETE FROM `chanels` WHERE id = :chanelId";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":chanelId", $chanelId);
        if ($stmt->execute()) {
            $response['success'] = true;
        } else {
            $response['error'] = "Couldn't delete chanel";
        }
    } else {
        $response['error'] = "Couldn't delete messages";
    }
}



echo json_encode($response);
