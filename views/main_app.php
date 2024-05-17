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
                <img id="home_logo" src="./assets/images/logo.png" alt="logo">
            </button>
            <!-- get user servers -->
            <?php
            foreach ($servers as $server) {
            ?>
                <div class="picture home">
                    <?php
                    if ($server['image'] == 'default') {
                    ?>
                        <img class="serverIco" serId=<?= $server['id'] ?> name="<?= $server['name'] ?>" src="./assets/images/serverIcons/default_server_icon.jpg ?>" alt="serverIco">
                    <?php
                    } else {
                    ?>
                        <img class="serverIco" serId=<?= $server['id'] ?> name="<?= $server['name'] ?>" src="./assets/images/serverIcons/<?= $server['image'] ?>" alt="serverIco">
                    <?php
                    }
                    ?>
                </div>

            <?php

            }
            ?>
            <div id="tooltip"></div>
            <!-- !get user servers -->
            <button class="home" id="add" onclick="addServer()">+</button>
        </div>

        <div class="profile">
            <div class="picture prof">
                <?php
                if ($_SESSION['currentUser']['image'] == 'default') {
                ?>
                    <img class="serverIco" src="./assets/images/userIcons/default_user_icon.png ?>" alt="userIcon">
                <?php
                } else {
                ?>
                    <img class="serverIco" src="./assets/images/userIcons/<?= $_SESSION['currentUser']['image'] ?>" alt="userIcon">
                <?php
                }
                ?>
            </div>
            <div class="picture ns">
                <img class="settings" src="./assets/images/gear.png" alt="settings">
            </div>
        </div>

        <div class="iframe">
            <iframe frameborder="0" src="./views/contacts.php" id="iframe"></iframe>
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

<script src="./assets/js/cex.js"></script>