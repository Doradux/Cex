<?php
if (session_status() == PHP_SESSION_NONE) session_start();

require_once '../../Model/DBconection.php';
$conn = DBconection::connectDB();

header('Content-Type: application/json');
$response = [];

if (isset($_POST['newServerName'])) {
    $newName = $_POST['newServerName'];
    $sql = "UPDATE `servers` SET `name` = :newName WHERE `id` = :serverId";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":newName", $newName);
    $stmt->bindParam(":serverId", $_SESSION['currentServer']['id']);

    if ($stmt->execute()) {
        $response['success'] = true;
        $_SESSION['currentServer']['name'] = $newName;
    } else {
        $response['error'] = "Server name coulnd't be updated";
    }
}

if (isset($_POST['chanelId'])) {
    $chanelId = $_POST['chanelId'];
    $chanelName = $_POST['chanelName'];

    try {
        if ($chanelId == "none") {
            $sql = "UPDATE `servers` SET `welcomeChanel` = NULL WHERE `id` = :serverId";
        } else {
            $sql = "UPDATE `servers` SET `welcomeChanel` = :newChanel WHERE `id` = :serverId";
        }
        $stmt = $conn->prepare($sql);

        // Vincular parámetros y ejecutar la consulta
        $stmt->bindParam(":serverId", $_SESSION['currentServer']['id']);
        if ($chanelId != "none") {
            $stmt->bindParam(":newChanel", $chanelId);
        }

        // Ejecutar la consulta
        if ($stmt->execute()) {
            $response['success'] = true;
            $_SESSION['currentServer']['welcomeChanel'] = $chanelName;
        } else {
            $response['error'] = "Error al actualizar el canal de bienvenida.";
        }
    } catch (PDOException $e) {
        $response['error'] = "Error en la conexión a la base de datos: " . $e->getMessage();
    } finally {
        // Cerrar la conexión
        $conn = null;
    }
} else {
    $response['error'] = "No se recibieron datos válidos.";
}

if (isset($_POST['serverPriv'])) {
    $priv = $_POST['serverPriv'];

    $sql = "UPDATE `servers` SET `privacity` = :priv WHERE `id` = :servId";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":priv", $priv);
    $stmt->bindParam(":servId", $_SESSION['currentServer']['id']);
    if ($stmt->execute()) {
        $_SESSION["currentServer"]["privacity"] = $priv;
        $response['success'] = true;
    } else {
        $response['error'] = "Privacity couldn't be changed";
    }
}

echo json_encode($response);
