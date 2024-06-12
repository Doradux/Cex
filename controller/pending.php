<?php
if (session_status() == PHP_SESSION_NONE) session_start();

require_once '../Model/DBconection.php';
$conn = DBconection::connectDB();

$pendings = [];
$pendingsIds = [];
$sql = "SELECT `user1` FROM `pending` WHERE `user2` = :userId";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":userId", $_SESSION['currentUser']['id']);

if ($stmt->execute()) {
    $pendingsIds = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (!empty($pendingsIds)) {
        $pendingIdsList = implode(',', array_map('intval', $pendingsIds));
        $sql = "SELECT * FROM `users` WHERE `id` IN ($pendingIdsList)";
        $stmt = $conn->prepare($sql);

        if ($stmt->execute()) {
            $pendings = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $_SESSION['pendings'] = $pendings;
        } else {
            $response['error'] = "Error fetching pendings data.";
        }
    }
}

//get request user info


include '../views/pending.php';
