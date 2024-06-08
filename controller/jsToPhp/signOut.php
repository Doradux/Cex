<?php
if (session_status() == PHP_SESSION_NONE) session_start();
session_destroy();

header('Content-Type: application/json');
echo json_encode(['success' => true]);
