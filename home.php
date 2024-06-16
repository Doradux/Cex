<?php
if (session_status() == PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['currentUser']['username'])) {
    header('Location: .');
}

include_once "./Model/User.php";
require_once './Model/DBconection.php';
$conn = DBconection::connectDB();

// Obtén los IDs de los servidores vinculados al usuario
$sql = "SELECT serverId FROM `user-server` WHERE userId = :userId";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':userId', $_SESSION["currentUser"]["id"], PDO::PARAM_INT);
$stmt->execute();
$joinedServersId = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

// Obtén los servidores donde el usuario se ha unido por serverId, incluyendo el nombre de la imagen
$servers = [];
if (!empty($joinedServersId)) {
    $placeholders = str_repeat('?,', count($joinedServersId) - 1) . '?';
    $sql = "
        SELECT s.*, si.name AS serverImg 
        FROM servers s 
        JOIN `server-image` si ON s.imageId = si.id 
        WHERE s.id IN ($placeholders)
    ";
    $stmt = $conn->prepare($sql);
    $stmt->execute($joinedServersId);
    $servers = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//getUsers
$sql = 'SELECT `id`, `username`, `displayname`, `imageId`, `creation` FROM users';
$stmt = $conn->prepare($sql);
$stmt->execute();
$_SESSION['serverUsers'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

//get friends requests
$pendings = [];
$pendingsIds = [];

$sql = "SELECT `user1` FROM `pending` WHERE `user2` = :userId";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":userId", $_SESSION['currentUser']['id']);

if ($stmt->execute()) {
    $pendingsIds = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
    if (!empty($pendingsIds)) {
        // get users who sent us a request
        $placeholders = implode(',', array_fill(0, count($pendingsIds), '?'));

        $sql = "SELECT `id`, `username`, `displayname`, `imageId` FROM `users` WHERE `id` IN ($placeholders)";
        $stmt = $conn->prepare($sql);

        foreach ($pendingsIds as $k => $id) {
            $stmt->bindValue(($k + 1), $id, PDO::PARAM_INT);
        }

        if ($stmt->execute()) {
            $pendings = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // get images
            foreach ($pendings as &$pending) {
                if ($pending['imageId']) {
                    $sql = 'SELECT `name` FROM `user-image` WHERE `id` = :imageId';
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':imageId', $pending['imageId'], PDO::PARAM_INT);
                    $stmt->execute();
                    $image = $stmt->fetch(PDO::FETCH_ASSOC);
                    $pending['image'] = $image ? $image['name'] : 'default.png';
                } else {
                    $pending['image'] = 'default.png';
                }
            }

            $_SESSION['pendings'] = $pendings;
        } else {
            $response['error'] = "Error fetching pendings data.";
        }
    } else {
        $_SESSION['pendings'] = [];
    }
} else {
    $response['error'] = "Error executing query.";
}

include './views/main_app.php';
