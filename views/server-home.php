<?php
if (session_status() == PHP_SESSION_NONE) session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>You are in</h2>
    <h1><?= $_SESSION['currentServer']['name'] ?></h1>
</body>

</html>

<style>
    @font-face {
        font-family: "poppins";
        src: url("../assets/fonts/Poppins-Regular.ttf");
        font-weight: normal;
        font-style: normal;
    }

    @font-face {
        font-family: "poppins_bold";
        src: url("../assets/fonts/Poppins-Bold.ttf");
        font-weight: normal;
        font-style: normal;
    }

    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        /* border: 1px solid black; */
        font-family: "poppins";
    }

    body {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        color: white;
        height: 100vh;
    }
</style>