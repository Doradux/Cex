<?php
if (session_status() == PHP_SESSION_NONE) session_start();

include_once "../../Model/User.php";
require_once '../../Model/DBconection.php';
$conn = DBconection::connectDB();

$u = $_POST['username'];
$p = $_POST['password'];
$response = [];

// include server img
$sql = '
    SELECT u.*, ui.name AS userImg
    FROM users u
    LEFT JOIN `user-image` ui ON u.imageId = ui.id
';
$users = $conn->query($sql);
$valid = false;

while ($user = $users->fetch(PDO::FETCH_ASSOC)) {
    if (strtolower($user['email']) == strtolower($u) && $user['password'] == $p) {
        $valid = true;
        $_SESSION['currentUser'] = $user;
        $dateString = $_SESSION['currentUser']['creation'];
        $date = new DateTime($dateString);
        $_SESSION['currentUser']['creation'] = $date->format('d/m/Y');
        $dateString = $_SESSION['currentUser']['birth'];
        $date = new DateTime($dateString);
        $_SESSION['currentUser']['birth'] = $date->format('d/m/Y');
        break;
    }
}

if ($valid) {
    $response['success'] = 'true';
} else {
    $response['error'] = "Wrong email or password.";
}

echo json_encode($response);
