<?php
if (session_status() == PHP_SESSION_NONE) session_start();

require_once '../../Model/DBconection.php';
$conn = DBconection::connectDB();
header('Content-Type: application/json');

$response = [];

//return users in search
if (isset($_POST['inputValue'])) {
    $inputValue = '%' . $_POST['inputValue'] . '%';
    $sql = "SELECT `id`, `username`, `displayname`, `imageId` FROM `users` WHERE `username` LIKE :inputValue";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':inputValue', $inputValue);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // get pending users id
    $pendingUserIds = [];
    $sql = "SELECT * FROM `pending` WHERE (`user1` = :id1 AND `user2` = :id2) OR (`user1` = :id2 AND `user2` = :id1)";
    $stmt = $conn->prepare($sql);

    foreach ($users as $user) {
        $stmt->bindParam(":id1", $user['id']);
        $stmt->bindParam(":id2", $_SESSION['currentUser']['id']);
        if ($stmt->execute()) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!empty($result)) {
                $pendingUserIds[] = $user['id'];
            }
        }
    }

    // filter no pending users
    $users = array_filter($users, function ($user) use ($pendingUserIds) {
        return !in_array($user['id'], $pendingUserIds) && $user['id'] != $_SESSION['currentUser']['id'];
    });

    // get users img
    foreach ($users as &$user) {
        if ($user['imageId']) {
            $sql = 'SELECT `name` FROM `user-image` WHERE `id` = :imageId';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':imageId', $user['imageId']);
            $stmt->execute();
            $image = $stmt->fetch(PDO::FETCH_ASSOC);

            $user['image'] = $image ? $image['name'] : 'default.png';
        } else {
            $user['image'] = 'default.png';
        }
    }

    $response = array_values($users);
}


//send friend request
if (isset($_POST['sendRequest'])) {
    $userId = $_POST['sendRequest'];

    // check theres not same pending request
    $sql = "SELECT * FROM `pending` WHERE (`user1` = :currentId AND `user2` = :userId) OR (`user1` = :userId AND `user2` = :currentId)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":currentId", $_SESSION['currentUser']['id']);
    $stmt->bindParam(":userId", $userId);
    $stmt->execute();
    $existingRequest = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($existingRequest)) {
        $sql = "INSERT INTO `pending` (`user1`, `user2`) VALUES (:currentId, :userId)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":currentId", $_SESSION['currentUser']['id']);
        $stmt->bindParam(":userId", $userId);

        if ($stmt->execute()) {
            $response['success'] = true;
        } else {
            $response['error'] = "Couldn't send request to the user";
        }
    } else {
        $response['error'] = "There is already a pending friend request with this user.";
    }
}

echo json_encode($response);
