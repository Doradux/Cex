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
        <div class="group" groupId="<?= $group['id'] ?>">
            <p><?= $group['name'] ?></p>
            <div class="group-options">
                <div class="group-modify group-option modify"><img src="../assets/icons/edit.svg" alt="edit"></div>
                <div class="group-delete group-option delete"><img src="../assets/icons/trash.svg" alt="edit"></div>
            </div>
        </div>
        </div>


    <?php
    }
    ?>
    <?php include '../assets/components/addGroup.php'; ?>
    <div class="add-group-right">
        <div class="add-new-group">
            <p id="add-group-btn">ADD NEW GROUP</p>
        </div>
    </div>

</body>

<script src="../assets/js/manage-groups.js"></script>

</html>