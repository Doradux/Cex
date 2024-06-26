<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/manage-server.css">
    <title>Document</title>
</head>

<body>
    <h1>SERVER OVERVIEW</h1>

    <div class="server-data">

        <div class="server-name">
            <p class="big">NAME</p>
            <div class="name-input">
                <input type="text" id="server-name" disabled value="<?= $_SESSION['currentServer']['name'] ?>">
                <button id="name-btn">EDIT</button>
            </div>
        </div>

        <div class="server-welcome">
            <p class="big">WELCOME CHANEL</p>
            <div class="current-welcome">
                <input type="text" id="current-welcome" disabled value="<?= $_SESSION['currentServer']['welcomeChanel'] ?>">
                <button id="change-welcome">EDIT</button>
            </div>
        </div>

    </div>

    <div class="server-privacity">
        <div class="priv-one">
            <p class="big">SERVER PRIVACITY</p>
        </div>

        <div id="privacity">
            <div id="typeHider">
                <div id="type-privacity"><img class="server-privacity-icon" src="../../assets/icons/no-visible.png" alt=""></div>
            </div>
            <div class="p-types">
                <p>Private</p>
                <p>Public</p>
            </div>
        </div>
    </div>

    <div class="server-photo">

        <div class="photo-settings">
            <p class="big">IMAGE</p>
            <div class="photo-new">

                <div class="photo-settings-one">
                    <div class="photo">
                        <img id="photo" src="../assets/images/serverImage/<?= $serverImg ?>" alt="server-image">
                        <label class="change-image-hover">
                            <input type="file" class="change-hover" accept="image/*" style="display: none;">
                            <img class="change-hover" src="../assets/images/change-image.png" alt="change-image">
                        </label>
                    </div>
                </div>
                <div class="photo-settings-two">
                    <p>We recommend an image of at least 512x512 for the server</p>
                    <input type="file" accept="image/*" id="image-input" style="display: none;">
                    <button class="upload-btn" onclick="document.getElementById('image-input').click();">UPLOAD IMAGE</button>
                    <button class="save-photo">Save</button>
                </div>

            </div>
        </div>


        <div class="grandimage-settings">
            <div class="grandimage-settings-one">
                <p class="big">GRAND-IMAGE</p>
                <div class="grandimage">
                    <img id="grandimage" src="../assets/images/grandImage/<?= $_SESSION['currentServer']['grandImageName'] ?>" alt="server-image">
                    <label class="change-grandimage-hover">
                        <input type="file" class="change-hover-grand" accept="image/*" style="display: none;">
                        <img class="change-hover" src="../assets/images/change-image.png" alt="change-image">
                    </label>
                </div>
            </div>
            <div class="grandimage-settings-two">
                <p>This image will display at the top of yout channels list</p>
                <p>The recommended minimun size is 960x540 and recommended aspect ratio is 16:9</p>
                <input type="file" accept="image/*" id="grandimage-input" style="display: none;">
                <button class="upload-btn" onclick="document.getElementById('grandimage-input').click();">UPLOAD GRANDIMAGE</button>
                <button class="save-grandimage">Save</button>
            </div>
        </div>

    </div>

    <?php
    //select welcome chanel
    include '../assets/components/select-welcome.php';

    ?>

</body>
<script>
    var privacity = "<?= $_SESSION['currentServer']['privacity'] ?>";
</script>
<script src="../assets/js/serverProperties.js"></script>

</html>