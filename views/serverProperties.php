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
            </div>
        </div>

        <div class="grandimage-settings">
        <p class="big">SERVER GRAND-IMAGE</p>
            <div class="grandimage">
                <img id="grandimage" src="../assets/images/grandImage/<?= $_SESSION['currentServer']['grandImageName'] ?>" alt="server-image">
            </div>
        </div>

    </div>
</body>

</html>