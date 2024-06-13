<?php
if (session_status() == PHP_SESSION_NONE) session_start();

require_once '../Model/DBconection.php';
$conn = DBconection::connectDB();

$_SESSION['friends'] = [];
$friends = [];

// get friends IDs
$sql = "SELECT `user2` FROM `friendships` WHERE `user1` = :userId";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":userId", $_SESSION['currentUser']['id']);

if ($stmt->execute()) {
    // fetch all friend IDs
    $friendsIds = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

    if (!empty($friendsIds)) {
        // create a string of IDs for the IN clause
        $friendsIdsList = implode(',', array_fill(0, count($friendsIds), '?'));

        // prepare the SQL query with placeholders
        $sql = "SELECT * FROM `users` WHERE `id` IN ($friendsIdsList)";
        $stmt = $conn->prepare($sql);

        // bind the friend IDs dynamically
        foreach ($friendsIds as $k => $id) {
            $stmt->bindValue(($k + 1), $id, PDO::PARAM_INT);
        }

        if ($stmt->execute()) {
            // fetch all friend data
            $friends = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // get images for friends
            foreach ($friends as &$friend) {
                if ($friend['imageId']) {
                    $sql = 'SELECT `name` FROM `user-image` WHERE `id` = :imageId';
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':imageId', $friend['imageId']);
                    $stmt->execute();
                    $image = $stmt->fetch(PDO::FETCH_ASSOC);

                    $friend['image'] = $image ? $image['name'] : 'default.png';
                } else {
                    $friend['image'] = 'default.png';
                }
            }

            $_SESSION['friends'] = $friends;
        } else {
            $response['error'] = "Error fetching friends data.";
        }
    }
} else {
    $response['error'] = "Error fetching friends IDs.";
}

include '../views/contacts.php';
