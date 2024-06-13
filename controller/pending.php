<?php
if (session_status() == PHP_SESSION_NONE) session_start();

require_once '../Model/DBconection.php';
$conn = DBconection::connectDB();

$pendings = [];
$pendingsIds = [];

$sql = "SELECT `user1` FROM `pending` WHERE `user2` = :userId";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":userId", $_SESSION['currentUser']['id']);


//research pendings
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

include '../views/pending.php';
