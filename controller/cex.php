<?php
// forced servers
$serverList = [
    ["id" => 1, "name" => "Los Pibes 😎", "img" => "../assets/images/1serverico.png"],
    ["id" => 2, "name" => "Netflix", "img" => "../assets/images/2serverico.png"],
    ["id" => 3, "name" => "Sodium", "img" => "../assets/images/3serverico.ico"],
    ["id" => 4, "name" => "Mascot", "img" => "../assets/images/4serverico.jpg"],
];

$profile = [
    'id' => 1,
    'email' => 'marcosloldorado@gmail.com',
    'username' => 'Doradux',
    'displayName' => 'MrTartaria',
    'icon' => '../assets/images/profile.jpg'
];


include '../views/main_app.php';
