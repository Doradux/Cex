<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/main_app.css">
    <title>Cex</title>
</head>

<body>
    <container>

        <div class="teams">
            <button id="home">
                <img id="home_logo" src="../assets/images/logo.png" alt="logo">
            </button>
            <!-- get user servers -->
            <?php
            foreach ($serverList as $server) {
            ?>
                <div class="picture home">
                    <img class="serverIco" src="<?= $server['img'] ?>" alt="serverIco">
                </div>
            <?php

            }
            ?>
            <!-- !get user servers -->
            <button class="home" id="add" onclick="addServer()">+</button>
        </div>

        <div class="profile">
            <div class="picture prof">
                <img src="<?= $profile['icon'] ?>" alt="profileIcon">
            </div>
            <div class="picture ns">
                <img class="settings" src="../assets/images/gear.png" alt="settings">
            </div>
        </div>

        <div class="iframe">
            <iframe frameborder="0" src="../views/contacts.php"></iframe>
        </div>

    </container>

    <modal id="modal">
        <form action="">
            <label for="joinServerId">
                Join a server:
            </label>
            <div>
                <input type="text" placeholder="Server id" name="joinServerId" id="joinServerId">
                <input id="joinS" type="submit" value="Join">
            </div>
        </form>
        <form action="">
            <label for="joinServerId">
                Create server:
            </label>
            <div>
                <input type="text" placeholder="Server name" name="createServerName" id="createServerName">
                <input id="createS" type="submit" value="Create!">
            </div>
        </form>
    </modal>
</body>

</html>

<script src="../assets/js/cex.js"></script>