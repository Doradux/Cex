<?php
if (session_status() == PHP_SESSION_NONE) session_start();

require_once '../../Model/DBconection.php';
$conn = DBconection::connectDB();
header('Content-Type: application/json');

$response = [];

if (isset($_POST['username'])) {
    $sql = 'UPDATE `users` SET `username` = :newUsername WHERE `id` = :currentId';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':newUsername', $_POST['username']);
    $stmt->bindParam(':currentId', $_SESSION['currentUser']['id']);

    if ($stmt->execute()) {
        $response['success'] = true;
        $_SESSION['currentUser']['username'] = $_POST['username'];
    } else {
        $response['error'] = "Username change failed";
    }
}

if (isset($_POST['displayname'])) {
    $sql = 'UPDATE `users` SET `displayname` = :newDisplayname WHERE `id` = :currentId';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':newDisplayname', $_POST['displayname']);
    $stmt->bindParam(':currentId', $_SESSION['currentUser']['id']);

    if ($stmt->execute()) {
        $response['success'] = true;
        $_SESSION['currentUser']['displyname'] = $_POST['displyname'];
    } else {
        $response['error'] = "Displayname change failed";
    }
}

if (isset($_POST['birth'])) {
    $sql = 'UPDATE `users` SET `Birth` = :newBirth WHERE `id` = :currentId';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':newBirth', $_POST['birth']);
    $stmt->bindParam(':currentId', $_SESSION['currentUser']['id']);

    if ($stmt->execute()) {
        $response['success'] = true;
        $_SESSION['currentUser']['Birth'] = $_POST['birth'];
    } else {
        $response['error'] = "Birth change failed";
    }
}

if (isset($_POST['newStatus'])) {
    $newStatus = $_POST['newStatus'];

    $sql = "UPDATE `users` SET `status` = :newStatus WHERE `id` = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":newStatus", $newStatus);
    $stmt->bindParam(":id", $_SESSION['currentUser']['id']);

    if ($stmt->execute()) {
        $response['success'] = true;
        $_SESSION['currentUser']['status'] = $newStatus;
    } else {
        $response['error'] = "Status coulnd't get set";
    }
}

echo json_encode($response);
