<?php
if (session_status() == PHP_SESSION_NONE) session_start();

include_once "../Model/User.php";
require_once '../Model/DBconection.php';

$conn = DBconection::connectDB();

//get server info
$sql = "SELECT * FROM `servers` WHERE id = '" . $_GET['serId'] . "'";
$currentServer = $conn->query($sql)->fetch(PDO::FETCH_ASSOC);

if ($currentServer['grandImage'] == 'default') {
    $grandImage = 'default.jpg';
} else {
    $grandImage = $currentServer['grandImage'];
}

//get server channels groups
$chanelsGroups = [];
$sql = "SELECT * FROM `chanelsgroup` WHERE serverId = " . $_GET['serId'] . "";
$result = $conn->query($sql);
while ($group = $result->fetch(PDO::FETCH_ASSOC)) {
    $chanelsGroups[] = $group;
}

//get user role
$sql = "SELECT * FROM `user-server` WHERE userId = " . $_SESSION['currentUser']['id'] . " AND serverId = " . $currentServer['id'];
$role = $conn->query($sql)->fetch(PDO::FETCH_ASSOC)['role'];

include '../views/server_content.php';
