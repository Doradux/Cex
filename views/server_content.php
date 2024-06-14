<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/server_content.css">
    <title>Document</title>
</head>

<script>
    var role = '<?= $role ?>';
</script>

<body>
    <div id="contextMenu" class="contextMenu">
        <div class="serverData" style="background-image: url('../assets/images/grandImage/<?= $_SESSION['currentServer']['grandImageName'] ?>');">
            <h4><?= $_SESSION['currentServer']['name'] ?></h4>
            <img id='arrow' src="../assets/images/arrow.svg" alt="arrow">
        </div>

        <div id="groups" class="groups">
            <?php
            foreach ($chanelsGroups as $group) {
            ?>
                <div class="chanelGroup" groupId='<?= $group['id'] ?>'>
                    <div class="fst">
                        <p><?= $group['name'] ?></p>
                        <?= ($role == 'admin') ? '<a class="addServerInGroup" href="' . $group['id'] . '">+</a>' : '' ?>

                    </div>

                    <div class="snd">
                        <?php
                        $chanels = [];
                        $sql = "SELECT * FROM `chanels` WHERE groupId = " . $group['id'];
                        $result = $conn->query($sql);
                        while ($chanel = $result->fetch(PDO::FETCH_ASSOC)) {
                            $chanels[] = $chanel;
                        }
                        foreach ($chanels as $chanel) {
                        ?>
                            <a class="chanelLink" href="<?= $chanel['id'] ?>"><?= ($chanel['type'] == 'chat') ? '#' : '⪨' ?><?= " " . $chanel['name'] ?></a>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>


    <div class="serverChanelContent">
        <iframe id="chanelContent" src="../views/server-home.php" frameborder="0"></iframe>
    </div>

    <div class="members">
        <h5>Members ~</h5>
        <?php foreach ($_SESSION['serverUsers'] as $serverUser) { ?>
            <div class="userCard">
                <div class="user-photo" style="background-image: url('../assets/images/userImage/<?= $serverUser['image'] ?>');"></div>
                <?php if ($serverUser['serverRole'] == 'user') { ?>
                    <p><?= $serverUser['name'] ?></p>
                <?php } else if ($serverUser['serverRole'] == 'admin') { ?>
                    <p style="color: darkcyan;"><?= $serverUser['name'] ?></p>
                <?php } ?>
            </div>
        <?php } ?>
    </div>

</body>


<?php
// component chanelsOptions
include '../assets/components/chanelsOptions.php';
// component serverOptions
include '../assets/components/serverOptions.php';
// component addChanel
include '../assets/components/addChanel.php';
// component confirmLeaveServer
include '../assets/components/confirmLeaveServer.php';
?>



<div id="tooltip"></div>

</html>

<script src="../assets/js/serverContent.js"></script>