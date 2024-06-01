<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/serverProperties.css">
    <title>Document</title>
</head>

<body>
    <div class="server-photo">

        <div class="photo-settings">
            <p class="big">SERVER IMAGE</p>
            <div class="photo">
                <img id="photo" src="../assets/images/serverImage/<?= $serverImg ?>" alt="server-image">
                <div class="change-image-hover">
                    <img class="change-hover" src="../assets/images/change-image.png" alt="change-image">
                </div>
            </div>
            <p>We recommend using photos with a 1:1 aspect ratio</p>
        </div>

        <div class="grandimage-settings">
            <p class="big">SERVER GRAND-IMAGE</p>
            <div class="grandimage">
                <img id="grandimage" src="../assets/images/grandImage/<?= $_SESSION['currentServer']['grandImageName'] ?>" alt="server-image">
                <div class="change-grandimage-hover">
                    <img class="change-hover" src="../assets/images/change-image.png" alt="change-image">
                </div>
            </div>
            <p>We recommend using photos with a 16:9 aspect ratio</p>
        </div>

    </div>

    <div class="server-data">
        
    </div>

</body>

<script src="../assets/js/serverProperties.js"></script>

</html>
