<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="./assets/images/logo.png">
    <link rel="stylesheet" href="./assets/css/main_app.css">
    <title>Cex</title>
</head>

<body>
    <container>

        <div class="teams">
            <button id="home">
                <?php
                if (count($_SESSION['pendings']) > 0) {
                ?>
                    <img id="home_logo" src="./assets/images/notification.gif" alt="logo">
                <?php
                } else {
                ?>
                    <img id="home_logo" src="./assets/images/logo.png" alt="logo">
                <?php
                }
                ?>
            </button>
            <!-- get user servers -->
            <?php
            foreach ($servers as $server) {
            ?>
                <div class="picture home">
                    <img class="serverIco" serId=<?= $server['id'] ?> name="<?= $server['name'] ?>" src="./assets/images/serverImage/<?= $server['serverImg'] ?>" alt="serverIco">
                </div>

            <?php

            }
            ?>
            <div id="tooltip"></div>
            <!-- !get user servers -->
            <button class="home" id="add" onclick="addServer()">+</button>
        </div>

        <div class="iframe">
            <iframe frameborder="0" src="./controller/landing.php" id="iframe"></iframe>
        </div>

        <div class="profile">
            <div class="picture prof" id="prof">
                <img class="" src="./assets/images/userImage/<?= $_SESSION['currentUser']['userImg'] ?>" alt="userIcon">
            </div>
        </div>

    </container>


    <!-- utilities -->
    <?php
    include './assets/components/join-server.php';
    include './assets/components/contextMenuProfile.php';
    include './assets/components/set-status.php';
    ?>

</body>

</html>

<script src="./assets/js/cex.js"></script>