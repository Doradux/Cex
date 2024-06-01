<?php
if (session_status() == PHP_SESSION_NONE) session_start();

require_once '../Model/DBconection.php';
include_once "../Model/User.php";

$conn = DBconection::connectDB();

// Obtener la información del servidor junto con el nombre de la imagen grandImage
$sql = "
    SELECT s.*, sg.name AS grandImageName 
    FROM `servers` s
    LEFT JOIN `server-grandImage` sg ON s.grandImageId = sg.id
    WHERE s.id = :serId
";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':serId', $_GET['serId'], PDO::PARAM_INT);
$stmt->execute();
$_SESSION['currentServer'] = $stmt->fetch(PDO::FETCH_ASSOC);

// Obtener los grupos de canales del servidor
$chanelsGroups = [];
$sql = "SELECT * FROM `chanelsgroup` WHERE serverId = :serId";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':serId', $_GET['serId'], PDO::PARAM_INT);
$stmt->execute();
while ($group = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $chanelsGroups[] = $group;
}


//get all server users id in server
$sql = "SELECT * FROM `user-server` WHERE serverId = " . $_SESSION['currentServer']['id'];
$stmt = $conn->query($sql);
$usersInServer = $stmt->fetchAll(PDO::FETCH_ASSOC);

$_SESSION['serverUsers'] = [];
//get all users main info, image
foreach ($usersInServer as $userInServer) {
    $role = $userInServer['role'];
    $serverNick = $userInServer['serverNick'];

    $sql = 'SELECT * FROM users WHERE id = ' . $userInServer['userId'];
    $stmt = $conn->query($sql);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $sql = 'SELECT * FROM `user-image` WHERE id = ' . $user['imageId'];
        $stmt = $conn->query($sql);
        $image = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($image) {
            $user['image'] = $image['name'];
        } else {
            $user['image'] = 'default.png';
        }

        $user['serverRole'] = $role;
        $user['serverNick'] = $serverNick;

        $_SESSION['serverUsers'][] = $user;
    }
}

//get nick to show in server
foreach ($_SESSION['serverUsers'] as &$user) {
    if ($user['serverNick'] != null) {
        $user['name'] = $user['serverNick'];
    } else if ($user['displayname'] != null) {
        $user['name'] = $user['displayname'];
    } else {
        $user['name'] = $user['username'];
    }
}
unset($user);

// get user role
// $sql = "SELECT role FROM `user-server` WHERE userId = :userId AND serverId = :serverId";
// $stmt = $conn->prepare($sql);
// $stmt->bindParam(':userId', $_SESSION['currentUser']['id'], PDO::PARAM_INT);
// $stmt->bindParam(':serverId', $_SESSION['currentServer']['id'], PDO::PARAM_INT);
// $stmt->execute();
// $role = $stmt->fetch(PDO::FETCH_ASSOC)['role'];
// $_SESSION['currentUser']['role'] = $role;
foreach ($_SESSION['serverUsers'] as $serverUser) {
    if ($serverUser['id'] == $_SESSION['currentUser']['id']) {
        $role = $serverUser['serverRole'];
        $_SESSION['currentUser']['role'] = $role;
    }
}

include '../views/server_content.php';
