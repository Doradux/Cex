<?php
if (session_status() == PHP_SESSION_NONE) session_start();

require_once '../../Model/DBconection.php';
$conn = DBconection::connectDB();
header('Content-Type: application/json');

$response = [];

// Return users in search
if (isset($_POST['inputValue'])) {
    $inputValue = '%' . $_POST['inputValue'] . '%';
    $sql = "SELECT `id`, `username`, `displayname`, `imageId` FROM `users` WHERE `username` LIKE :inputValue";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':inputValue', $inputValue);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Get pending users ids
    $pendingUserIds = [];
    $sql = "SELECT `user1`, `user2` FROM `pending` WHERE `user1` = :id1 OR `user2` = :id1";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id1", $_SESSION['currentUser']['id']);
    $stmt->execute();
    $pendingResults = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($pendingResults as $pending) {
        $pendingUserIds[] = $pending['user1'] == $_SESSION['currentUser']['id'] ? $pending['user2'] : $pending['user1'];
    }

    // Get friendships ids
    $friendshipUserIds = [];
    $sql = "SELECT `user1`, `user2` FROM `friendships` WHERE `user1` = :id1 OR `user2` = :id1";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id1", $_SESSION['currentUser']['id']);
    $stmt->execute();
    $friendshipResults = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($friendshipResults as $friendship) {
        $friendshipUserIds[] = $friendship['user1'] == $_SESSION['currentUser']['id'] ? $friendship['user2'] : $friendship['user1'];
    }

    // Filter no pending and no friendship users
    $users = array_filter($users, function ($user) use ($pendingUserIds, $friendshipUserIds) {
        return !in_array($user['id'], $pendingUserIds) && !in_array($user['id'], $friendshipUserIds) && $user['id'] != $_SESSION['currentUser']['id'];
    });

    // Get users img
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

// Send friend request
if (isset($_POST['sendRequest'])) {
    $userId = $_POST['sendRequest'];

    // Check there's no same pending request
    $sql = "SELECT * FROM `pending` WHERE (`user1` = :currentId AND `user2` = :userId) OR (`user1` = :userId AND `user2` = :currentId)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":currentId", $_SESSION['currentUser']['id']);
    $stmt->bindParam(":userId", $userId);
    $stmt->execute();
    $existingRequest = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Check there's no existing friendship
    $sql = "SELECT * FROM `friendships` WHERE (`user1` = :currentId AND `user2` = :userId) OR (`user1` = :userId AND `user2` = :currentId)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":currentId", $_SESSION['currentUser']['id']);
    $stmt->bindParam(":userId", $userId);
    $stmt->execute();
    $existingFriendship = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($existingRequest) && empty($existingFriendship)) {
        $sql = "INSERT INTO `pending` (`user1`, `user2`) VALUES (:currentId, :userId)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":currentId", $_SESSION['currentUser']['id']);
        $stmt->bindParam(":userId", $userId);

        if ($stmt->execute()) {
            // $response['success'] = true;
            //get user data
            $sql = "SELECT `id`, `username`, `displayname`, `imageId` FROM `users` WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":id", $userId);
            if ($stmt->execute()) {
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($user) {
                    //get user image if imageId is set
                    if (!empty($user['imageId'])) {
                        $sql = "SELECT `name` FROM `user-image` WHERE `id` = :imageId";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(":imageId", $user['imageId']);
                        if ($stmt->execute()) {
                            $image = $stmt->fetch(PDO::FETCH_ASSOC);
                            if ($image) {
                                $user["image"] = $image["name"];
                                $response['user'] = $user;
                                $response['success'] = true;
                            } else {
                                $response["error"] = "Couldn't fetch user image";
                            }
                        } else {
                            $response["error"] = "Couldn't execute user image query";
                        }
                    } else {
                        $user["image"] = "default.jpg";
                    }
                } else {
                    $response["error"] = "User not found";
                }
            } else {
                $response["error"] = "Couldn't fetch user";
            }
        } else {
            $response['error'] = "Couldn't send request to the user";
        }
    } else {
        $response['error'] = "There is already a pending friend request or an existing friendship with this user.";
    }
}

// Accept request
if (isset($_POST['addId'])) {
    $reqId = $_POST['addId'];

    $sql = "INSERT INTO `friendships` (`user1`, `user2`) VALUES (:user1, :user2), (:user2, :user1)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":user1", $_SESSION['currentUser']['id']);
    $stmt->bindParam(":user2", $reqId);
    if ($stmt->execute()) {
        $sql = "DELETE FROM `pending` WHERE (`user1` = :user1 AND `user2` = :user2) OR (`user1` = :user2 AND `user2` = :user1)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":user1", $_SESSION['currentUser']['id']);
        $stmt->bindParam(":user2", $reqId);
        if ($stmt->execute()) {
            foreach ($_SESSION['pendings'] as $key => $pending) {
                if ($pending['id'] == $reqId) {
                    unset($_SESSION['pendings'][$key]);
                }
            }
            // Reindex the array
            $_SESSION['pendings'] = array_values($_SESSION['pendings']);

            //create private chanel
            $sql = "INSERT INTO `chanels` (`name`, `groupId`, `type`) VALUES (:name, 0, 'chat')";
            $stmt = $conn->prepare($sql);
            $name = $_SESSION['currentUser']['id'] . '-' . $reqId;
            $stmt->bindParam(':name', $name);
            if ($stmt->execute()) {
                $response['success'] = true;
            } else {
                $response['error'] = "Couldn't create private chanel pending request.";
            }
        } else {
            $response['error'] = "Couldn't delete pending request.";
        }
    } else {
        $response['error'] = "Couldn't add friendship.";
    }
}

echo json_encode($response);
