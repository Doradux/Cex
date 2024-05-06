<?php
if (session_status() == PHP_SESSION_NONE) session_start();

include_once "./Model/User.php";
require_once './Model/DBconection.php';
$conn = DBconection::connectDB();


//get servers ids linked to user
$sql = "SELECT * FROM `user-server` WHERE userId = '" . $_SESSION["currentUser"]["id"] . "'";
$joinedServersId = $conn->query($sql);

//get servers where user joined by server id
$servers = [];
while ($row = $joinedServersId->fetch(PDO::FETCH_ASSOC)) {
    $sql = "SELECT * FROM servers WHERE id = '" . $row['serverId'] . "'";
    $result = $conn->query($sql);
    $servers[] = $result->fetch(PDO::FETCH_ASSOC);
}

include './views/main_app.php';
