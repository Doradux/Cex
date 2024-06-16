<?php
if (session_status() == PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['currentUser']['username'])) {
    header('Location: .');
}

$cover = explode('@', $_SESSION['currentUser']['email']);
$cover = $cover[0];

include '../views/editProfile.php';
