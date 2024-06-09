<?php
if (session_status() == PHP_SESSION_NONE) session_start();

require_once '../../Model/DBconection.php';
$conn = DBconection::connectDB();
header('Content-Type: application/json');

//     users
//      | user-image
//      | user-server
//      L server
//          | server-image
//          | server-grandimage
//          L groups
//              L chanels
//     friendship
//     blocks

$response = [];

// friendships
$sql = "DELETE FROM `friendships` WHERE `user1` = :userId OR `user2` = :userId";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':userId', $_SESSION['currentUser']['id']);
if ($stmt->execute()) {
    $response['success']['friendships'] = true;
} else {
    $response['error']['friendships'] = "Friendships couldn't be deleted";
}

// blocks
$sql = "DELETE FROM `user-block` WHERE `user1` = :userId OR `user2` = :userId";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':userId', $_SESSION['currentUser']['id']);
if ($stmt->execute()) {
    $response['success']['blocks'] = true;
} else {
    $response['error']['blocks'] = "Blocks couldn't be deleted";
}

// IDs servers
$sql = "SELECT `id` FROM `servers` WHERE `ownerId` = :userId";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':userId', $_SESSION['currentUser']['id']);
if ($stmt->execute()) {
    $serverIds = $stmt->fetchAll(PDO::FETCH_COLUMN);
}

// imageIds servers
$sql = "SELECT `imageId` FROM `servers` WHERE `ownerId` = :userId";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':userId', $_SESSION['currentUser']['id']);
if ($stmt->execute()) {
    $imagesId = $stmt->fetchAll(PDO::FETCH_COLUMN);
}

// grandImageIds servers
$sql = "SELECT `grandImageId` FROM `servers` WHERE `ownerId` = :userId";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':userId', $_SESSION['currentUser']['id']);
if ($stmt->execute()) {
    $grandimagesId = $stmt->fetchAll(PDO::FETCH_COLUMN);
}

// groupsIds servers
if ($serverIds) {
    $sql = "SELECT `groupId` FROM `chanelsgroup` WHERE `serverId` IN (" . implode(',', array_fill(0, count($serverIds), '?')) . ")";
    $stmt = $conn->prepare($sql);
    if ($stmt->execute($serverIds)) {
        $groupsId = $stmt->fetchAll(PDO::FETCH_COLUMN);
        $response['success']['get-groups-id'] = true;
    } else {
        $response['error']['get-groups-id'] = "Groups id couldn't be reached";
    }
}

// chanels
if ($groupsId) {
    $sql = "DELETE FROM `chanels` WHERE `groupId` IN (" . implode(',', array_fill(0, count($groupsId), '?')) . ")";
    $stmt = $conn->prepare($sql);
    if ($stmt->execute($groupsId)) {
        $response['success']['server-chanels'] = true;
    } else {
        $response['error']['server-chanels'] = "Server chanels couldn't be deleted";
    }
}

// groups
if ($serverIds) {
    $sql = "DELETE FROM `chanelsgroup` WHERE `serverId` IN (" . implode(',', array_fill(0, count($serverIds), '?')) . ")";
    $stmt = $conn->prepare($sql);
    if ($stmt->execute($serverIds)) {
        $response['success']['server-groups'] = true;
    } else {
        $response['error']['server-groups'] = "Server groups couldn't be deleted";
    }
}

// servers
$sql = "DELETE FROM `servers` WHERE `ownerId` = :userId";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':userId', $_SESSION['currentUser']['id']);
if ($stmt->execute()) {
    $response['success']['server'] = true;
} else {
    $response['error']['server'] = "Server couldn't be deleted";
}

// server images
if ($imagesId) {
    $filteredImagesId = array_filter($imagesId, function ($id) {
        return $id != 1;
    });

    if (!empty($filteredImagesId)) {
        $sql = "DELETE FROM `images` WHERE `id` IN (" . implode(',', array_fill(0, count($filteredImagesId), '?')) . ")";
        $stmt = $conn->prepare($sql);
        if ($stmt->execute($filteredImagesId)) {
            $response['success']['server-image'] = true;
        } else {
            $response['error']['server-image'] = "Server images couldn't be deleted";
        }
    } else {
        $response['info']['server-image'] = "No server images to delete after filtering.";
    }
}


// server grandimages
if ($grandimagesId) {
    $filteredGrandimagesId = array_filter($grandimagesId, function ($id) {
        return $id != 1;
    });

    if (!empty($filteredGrandimagesId)) {
        $sql = "DELETE FROM `server-grandimage` WHERE `id` IN (" . implode(',', array_fill(0, count($filteredGrandimagesId), '?')) . ")";
        $stmt = $conn->prepare($sql);
        if ($stmt->execute($filteredGrandimagesId)) {
            $response['success']['server-grandimage'] = true;
        } else {
            $response['error']['server-grandimage'] = "Server grandimages couldn't be deleted";
        }
    } else {
        $response['info']['server-grandimage'] = "No server grandimages to delete after filtering.";
    }
}

// user-server
$sql = "DELETE FROM `user-server` WHERE `userId` = :userId";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':userId', $_SESSION['currentUser']['id']);
if ($stmt->execute()) {
    $response['success']['user-server'] = true;
} else {
    $response['error']['user-server'] = "User-server couldn't be deleted";
}

// user-image
$sql = "DELETE FROM `user-image` WHERE `id` = :imageId";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':imageId', $_SESSION['currentUser']['imageId']);
if ($_SESSION['currentUser']['imageId'] != 1) {
    if ($stmt->execute()) {
        $response['success']['user-image'] = true;
    } else {
        $response['error']['user-image'] = "User-image couldn't be deleted";
    }
}

// user
$sql = "DELETE FROM `users` WHERE `id` = :userId";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':userId', $_SESSION['currentUser']['id']);
if ($stmt->execute()) {
    $response['success']['user'] = true;
} else {
    $response['error']['user'] = "User couldn't be deleted";
}

header('Content-Type: application/json');
echo json_encode($response);
