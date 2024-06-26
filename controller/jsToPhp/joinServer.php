<?php
if (session_status() == PHP_SESSION_NONE) session_start();

include_once "../../Model/User.php";
require_once '../../Model/DBconection.php';
$conn = DBconection::connectDB();

$serverDinamicId = $_POST['serverId'];
$response = [];

try {
    $stmt = $conn->prepare("SELECT * FROM `servers` WHERE `dinamicId` = :dinamicId");
    $stmt->bindParam(":dinamicId", $serverDinamicId, PDO::PARAM_STR);
    $stmt->execute();
    $server = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($server) {
        $serverId = $server['id'];
    } else {
        throw new Exception("Not a valid dynamic server ID");
    }

    $userId = $_SESSION['currentUser']['id'];

    $addServer = "INSERT INTO `user-server` (`userId`, `serverId`, `role`) VALUES (:userId, :serverId, 'user')";
    $userServers = "SELECT * FROM `user-server` WHERE `userId` = :userId";
    $serverExists = "SELECT * FROM `servers`";

    function validServer($conn, $serverId, $serverExists)
    {
        $stmt = $conn->query($serverExists);
        $allServers = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($allServers as $server) {
            if ($server['id'] == $serverId) {
                return true;
            }
        }
        return false;
    }

    function userNotInYet($conn, $serverId, $userServers, $userId)
    {
        $stmt = $conn->prepare($userServers);
        $stmt->execute([':userId' => $userId]);
        $uServers = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($uServers as $join) {
            if ($join['serverId'] == $serverId) {
                return false;
            }
        }
        return true;
    }

    if (validServer($conn, $serverId, $serverExists) && userNotInYet($conn, $serverId, $userServers, $userId)) {
        $stmt = $conn->prepare($addServer);
        if ($stmt->execute([':userId' => $userId, ':serverId' => $serverId])) {
            // Check if server-welcome set, add welcome message
            $sql = "SELECT `welcomeChanel` FROM `servers` WHERE `id` = :serverId";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":serverId", $serverId, PDO::PARAM_INT);
            if ($stmt->execute()) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($result && $result['welcomeChanel']) {
                    $chanelId = $result['welcomeChanel'];
                    $sql = "INSERT INTO `messages` (`content`, `userId`, `chanelId`) VALUES (:content, :userId, :chanelId)";
                    $stmt = $conn->prepare($sql);
                    $content = "<span>@" . $_SESSION['currentUser']['username'] . "</span> has joined the server";
                    if ($stmt->execute([':content' => $content, ':userId' => 0, ':chanelId' => $chanelId])) {
                        $response['success'] = 'Welcome message has been added';
                    } else {
                        $response['error'] = "Welcome message couldn't be added";
                    }
                } else {
                    $response['info'] = "No welcome channel set";
                }
            } else {
                $response['error'] = "Couldn't select welcome channel";
            }
            $response['status'] = 'success';
        } else {
            throw new Exception("Error: couldn't join the server");
        }
    } else {
        $response['status'] = 'error';
        if (!validServer($conn, $serverId, $serverExists)) {
            $response['message'] = 'Error: not a valid server';
        } elseif (!userNotInYet($conn, $serverId, $userServers, $userId)) {
            $response['message'] = 'Error: already on the server';
        } else {
            $response['message'] = 'Error: uncaught error';
        }
    }
} catch (Exception $e) {
    $response['status'] = 'error';
    $response['message'] = $e->getMessage();
}

header('Content-Type: application/json');
echo json_encode($response);
