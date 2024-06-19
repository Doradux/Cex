<?php
if (session_status() == PHP_SESSION_NONE) session_start();

require_once '../../Model/DBconection.php';
$conn = DBconection::connectDB();

header('Content-Type: application/json');

$response = array('success' => false);

$uploadDir = '../../assets/images/grandImage/';

if (!is_dir($uploadDir)) {
    $response['error'] = 'Upload directory does not exist.';
} elseif (!is_writable($uploadDir)) {
    $response['error'] = 'Upload directory is not writable. Permissions: ' . substr(sprintf('%o', fileperms($uploadDir)), -4);
} else {
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $rand = mt_rand(1000000, 9999999);
        $name = $rand . basename($_FILES['file']['name']);

        $uploadFile = $uploadDir . $name;

        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {
            $sql = 'INSERT INTO `server-grandimage` (`name`) VALUES (:name)';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':name', $name);

            if ($stmt->execute()) {
                $lastId = $conn->lastInsertId();

                $sql = 'UPDATE `servers` SET `grandImageId` = :lastId WHERE `id` = :serverId';
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':lastId', $lastId, PDO::PARAM_INT);
                $stmt->bindParam(':serverId', $_SESSION['currentServer']['id'], PDO::PARAM_INT);

                if ($stmt->execute()) {
                    $response['success'] = true;
                    $response['file'] = $name;
                } else {
                    $response['error'] = 'Failed to update server imageId.';
                }
            } else {
                $response['error'] = 'Failed to insert image record.';
            }
        } else {
            $response['error'] = 'Failed to move uploaded file.';
        }
    } else {
        $response['error'] = 'No file uploaded or file upload error.';
    }
}

echo json_encode($response);
