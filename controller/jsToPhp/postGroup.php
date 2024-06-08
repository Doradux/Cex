<?php
if (session_status() == PHP_SESSION_NONE) session_start();

require_once '../../Model/DBconection.php';
$conn = DBconection::connectDB();

$response = array();  // Inicializar el array de respuesta

if (isset($_POST['groupName'])) {
    $groupName = $_POST['groupName'];
    $sql = "INSERT INTO `chanelsgroup` (name, serverId) VALUES (:name, :serverId)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name', $groupName);
    $stmt->bindParam(':serverId', $_SESSION['currentServer']['id']);

    if ($stmt->execute()) {
        $response['success'] = true;

        // Refrescar la lista de grupos de la sesión
        $chanelsGroups = [];
        $sql = "SELECT * FROM `chanelsgroup` WHERE serverId = :serId";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':serId', $_SESSION['currentServer']['id'], PDO::PARAM_INT);
        $stmt->execute();
        while ($group = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $chanelsGroups[] = $group;
        }
        $_SESSION['groups'] = $chanelsGroups;
    } else {
        $response['error'] = "Group couldn't be uploaded";
    }
} else {
    $response['error'] = "Group name is not set";
}

header('Content-Type: application/json');
echo json_encode($response);
