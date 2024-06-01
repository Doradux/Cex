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
            <p class="big">SERVER SETTINGS</p>
            <p class="tiny"><?= strtoupper($_SESSION['currentServer']['name']) ?></p>
        </div>

        <div class="options">
            <?= $_SESSION['currentUser']['role'] == 'admin' ? '<p id="manage-server">Manage server properties</p>' : '' ?>
            <?= $_SESSION['currentUser']['role'] == 'admin' ? '<p id="manage-members-page">Manage members</p>' : '' ?>
            <p id="members-page">Members</p>
            <p class="delete red">Delete server</p>
        </div>

        <div class="go-back">
            <p id="back" class="back">Go back</p>
        </div>

    </div>

    <div class="iframe">
        <iframe src="../controller/serverProperties.php" frameborder="0"></iframe>
    </div>
</body>

<script src="../assets/js/serverSettings.js"></script>

</html>