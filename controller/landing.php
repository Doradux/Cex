<?php
if (session_status() == PHP_SESSION_NONE) session_start();

require_once '../Model/DBconection.php';
$conn = DBconection::connectDB();
$_SESSION['currentUser']['role'] = '';

include '../views/landing.php';
