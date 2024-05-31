<?php
if (session_status() == PHP_SESSION_NONE) session_start();

require_once '../Model/DBconection.php';

$sql = "SELECT userId FROM `user-server` WHERE serverId = " . $currentServer['id'];
$stmt = $conn->query($sql);
$usersId = $stmt->fetchAll(PDO::FETCH_ASSOC);



include '../views/members.php';
