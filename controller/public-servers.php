<?php
if (session_status() == PHP_SESSION_NONE) session_start();

require_once '../Model/DBconection.php';
include_once "../Model/User.php";

$conn = DBconection::connectDB();

echo $_GET['page'];

include '../views/public-servers.php';
