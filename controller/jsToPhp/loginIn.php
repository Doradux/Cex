<?php
if (session_status() == PHP_SESSION_NONE) session_start();

include_once "../../Model/User.php";
require_once '../../Model/DBconection.php';
$conn = DBconection::connectDB();

$u = $_POST['username'];
$p = $_POST['password'];

$sql = 'SELECT * FROM users';
$users = $conn->query($sql);
$valid = false;
while ($user = $users->fetch(PDO::FETCH_ASSOC)) {
    if ($user['username'] == $u && $user['password'] == $p) {
        $valid = true;
        $e = $user['username'];
        $_SESSION['currentUser'] = $user;
    };
};

if ($valid) {
    $response['status'] = 'success';
} else {
    $response['status'] = 'error';
    $response['message'] = 'Error: user not found';
}

echo json_encode($response);
