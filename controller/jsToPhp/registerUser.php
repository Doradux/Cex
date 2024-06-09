<?php
if (session_status() == PHP_SESSION_NONE) session_start();

include_once "../../Model/User.php";
require_once '../../Model/DBconection.php';
$conn = DBconection::connectDB();

$u = $_POST['username'];
$b = $_POST['birth'];
$p = $_POST['password'];
$e = $_POST['email'];
if (isset($_POST['displayName'])) {
    $dn = $_POST['displayName'];
} else {
    $dn = '';
};

$sql = 'SELECT * FROM users';
$users = $conn->query($sql);
$valid = true;
while ($user = $users->fetch(PDO::FETCH_ASSOC)) {
    if ($user['email'] == $e) {
        //must show error
        $valid = false;
    };
};

if ($valid) {
    $sql = "INSERT INTO `users` (`username`, `displayname`, `email`, `password`, `imageId`, `birth`) VALUES ('$u', '$dn', '$e', '$p', '1', '$b')";
    if ($conn->query($sql)) {
        $response['status'] = 'success';
        $response['message'] = 'User has been added.';
        $sql = '
    SELECT u.*, ui.name AS userImg
    FROM users u
    LEFT JOIN `user-image` ui ON u.imageId = ui.id
';
        $users = $conn->query($sql);
        $valid = false;

        while ($user = $users->fetch(PDO::FETCH_ASSOC)) {
            if ($user['email'] == $e) {
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
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Error: user couldn\'t be added.';
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Error: email already in use.';
};

echo json_encode($response);
