<?php
if (session_status() == PHP_SESSION_NONE) session_start();

require_once '../Model/DBconection.php';

$members = $_SESSION['serverUsers'];


include '../views/manage-members.php';
