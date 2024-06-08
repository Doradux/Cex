<?php
if (session_status() == PHP_SESSION_NONE) session_start();

require_once '../../Model/DBconection.php';
$conn = DBconection::connectDB();
header('Content-Type: application/json');

$response = array();

$sql = 'SELECT `password` FROM `users` WHERE `id` = :currentId';
$stmt = $conn->prepare($sql);
$stmt->bindParam(':currentId', $_SESSION['currentUser']['id']);

if ($stmt->execute()) {
    $old = $stmt->fetchColumn();
}

if ($_POST['old'] == $old && $_POST['new'] == $_POST['confirm']) {
    $sql = 'UPDATE `users` SET `password` = :newPassword WHERE `id` = :currentId';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':newPassword', $_POST['new']);
    $stmt->bindParam(':currentId', $_SESSION['currentUser']['id']);

    if ($stmt->execute()) {
        $response['success'] = true;
        $_SESSION['currentUser']['password'] = $_POST['new'];
    } else {
        $response['error'] = "Password change failed";
    }
} else if ($_POST['old'] == $old && $_POST['new'] != $_POST['confirm']) {
    $response['error'] = "Passwords doesn't match";
} else if ($_POST['old'] != $old) {
    $response['error'] = "Current password doesn't match";
} else {
    $response['error'] = "Unexpected error";
}

echo json_encode($response);
