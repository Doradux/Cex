<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/manage-groups.css">
    <title>Document</title>
</head>

<body>
    <h1>MANAGE SERVER GROUPS</h1>
    <?php
    foreach ($_SESSION['groups'] as $group) {
    ?>
        <div class="group">
            <p><?= $group['name'] ?></p>
            <div class="group-options">
                <div class="group-modify group-option modify">✏️</div>
                <div class="group-delete group-option delete">🗑️</div>
            </div>
        </div>
        </div>


    <?php
    }
    ?>
    <div class="add-new-group">
        <p>ADD NEW GROUP</p>
    </div>
</body>

</html>