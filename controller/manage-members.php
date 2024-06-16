<?php
if (session_status() == PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['currentUser']['username'])) {
    header('Location: .');
}

require_once '../Model/DBconection.php';

$members = $_SESSION['serverUsers'];


include '../views/manage-members.php';
