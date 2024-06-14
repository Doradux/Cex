<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/manage-chanels.css">
    <title>Document</title>
</head>

<body>
    <h1>MANAGE SERVER CHANELS</h1>
    <?php
    $chanels = [];
    foreach ($_SESSION['groups'] as $group) {
        $chanels = [];
        $sql = "SELECT * FROM `chanels` WHERE groupId = :groupId";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':groupId', $group['id']);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $chanels = array_merge($chanels, $result);
    ?>
        <div class="chanels-group big"><?= $group['name'] ?></div>
        <?php
        foreach ($chanels as $chanel) {
        ?>
            <div class="chanel" chanelId="<?= $chanel['id'] ?>">
                <div class="chanel-part1">
                    <div class="chanel-tags">
                        <?= $chanel['type'] == 'chat' ? "<p># " . $chanel['name'] . "</p>" : "<p>⪨ " . $chanel['name'] . "</p>" ?>
                    </div>
                </div>
                <div class="chanel-part2">
                    <div class="chanel-options">
                        <div class="chanel-modify chanel-option modify"><img src="../assets/icons/edit.svg" alt="edit"></div>
                        <div class="chanel-delete chanel-option delete"><img src="../assets/icons/trash.svg" alt="edit"></div>
                    </div>
                </div>
            </div>


        <?php
        }
        ?>
        <div class="add-chanel-right">
            <div class="add-new-chanel" groupId="<?= $group['id'] ?>">
                <p class="add-new-chanel-btn">ADD NEW CHANEL</p>
            </div>
        </div>
    <?php
    }
    include '../assets/components/addChanel.php';
    ?>
</body>

<script src="../assets/js/manage-chanels.js"></script>

</html>