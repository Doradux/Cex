<?php
if (session_status() == PHP_SESSION_NONE) session_start();

require_once 'DBconection.php';
$conexion = DBconection::connectDB();

if (isset($_POST['create'])) {
    $name = $_POST['name'];
    $creationTime = $_POST['creationTime'];

    $sql = "INSERT INTO `servers` (`name`, `creationTime`, `image`) VALUES ('$name', '$creationTime', 'default')";
    $conexion->query($sql);
}