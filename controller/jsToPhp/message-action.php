<?php
if (session_status() == PHP_SESSION_NONE) session_start();

require_once '../../Model/DBconection.php';
$conn = DBconection::connectDB();

header('Content-Type: application/json');
$response = [];

//delete msg
try {
    if (isset($_POST['delId'])) {
        $msgId = $_POST['delId'];

        $sql = "DELETE FROM `messages` WHERE id = :msgId";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":msgId", $msgId);

        if ($stmt->execute()) {
            foreach ($_SESSION['msgs'] as $index => $msg) {
                if ($msg['id'] == $msgId) {
                    unset($_SESSION['msgs'][$index]);
                    $response['success'] = true;
                    break;
                }
            }
        } else {
            $response['error'] = "Message couldn't be removed";
        }
    }
} catch (Exception $e) {
    $response['error'] = "An error occurred: " . $e->getMessage();
}

//modify smg
try {
    if (isset($_POST['modId'])) {
        $msgId = $_POST['modId'];
        $newContent = $_POST['newMsg'];
        $response['params']['modId'] = $msgId;
        $response['params']['newContent'] = $newContent;

        $sql = "UPDATE `messages` SET `content` = :newContent, `modified` = 1 WHERE `id` = :msgId";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":msgId", $msgId);
        $stmt->bindParam(":newContent", $newContent);

        if ($stmt->execute()) {
            $rowCount = $stmt->rowCount(); // Obtener el número de filas afectadas
            if ($rowCount > 0) {
                foreach ($_SESSION['msgs'] as $index => $msg) {
                    if ($msg['id'] == $msgId) {
                        $_SESSION['msgs'][$index]['content'] = $newContent;
                        $_SESSION['msgs'][$index]['modified'] = 1;
                        $response['success'] = true;
                        break;
                    }
                }
            } else {
                $response['error'] = "No rows were affected by the update.";
            }
        } else {
            $response['error'] = "Message couldn't be modified";
        }
    }
} catch (Exception $e) {
    $response['error'] = "An error occurred: " . $e->getMessage();
}

echo json_encode($response);
