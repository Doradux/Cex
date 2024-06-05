<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/serverSettings.css">
    <title>Document</title>
</head>

<body>
    <div class="left-menu">
        <div class="title">
            <p class="big"><?= strtoupper($_SESSION['currentServer']['name']) ?></p>
        </div>

        <div class="options">
            <?= $_SESSION['currentUser']['role'] == 'admin' ? '<p class="option" id="manage-server">OVERVIEW</p>' : '' ?>
            <?= $_SESSION['currentUser']['role'] == 'admin' ? '<p class="option" id="manage-groups">GROUPS</p>' : '' ?>
            <?= $_SESSION['currentUser']['role'] == 'admin' ? '<p class="option" id="manage-chanels">CHANELS</p>' : '' ?>
            <p class="option" id="members-page">MEMBERS</p>
            <?= $_SESSION['currentUser']['role'] == 'admin' ? '<p class="option" id="manage-members">MANAGE MEMBERS</p>' : '' ?>
            <p class="option delete red">DELETE SERVER</p>
        </div>

        <div class="go-back">
            <p id="back" class="back">GO BACK</p>
        </div>

    </div>

    <div class="iframe">
        <iframe id="frame" page="1" src="../controller/manage-server.php" frameborder="0"></iframe>
    </div>
</body>

<script src="../assets/js/serverSettings.js"></script>

</html>