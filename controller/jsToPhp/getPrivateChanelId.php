<?php
if (session_status() == PHP_SESSION_NONE) session_start();

require_once '../../Model/DBconection.php';
$conn = DBconection::connectDB();
header('Content-Type: application/json');

$response = [];

if (isset($_POST['friendId'])) {
    $friendId = $_POST['friendId'];

    $sql = "SELECT `id` FROM `chanels` WHERE `name` = :name1 OR `name` = :name2";
    $name1 = $_SESSION['currentUser']['id'] . "-" . $friendId;
    $name2 = $friendId . "-" . $_SESSION['currentUser']['id'];
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":name1", $name1);
    $stmt->bindParam(":name2", $name2);
    if ($stmt->execute()) {
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!empty($result)) {
            $response['success'] = true;
            $response['chanelId'] = $result;
        } else {
            $reponse['error'] = "No chanel found";
        }
    }
}

echo json_encode($response);
