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
        <div class="serverData" style="background-image: url('../assets/images/grandImage/<?= $grandImage ?>');">
            <h4><?= $currentServer['name'] ?></h4>
            <img id='arrow' src="../assets/images/arrow.svg" alt="arrow">
        </div>

        <div id="groups" class="groups">
            <?php
            foreach ($chanelsGroups as $group) {
            ?>
                <div class="chanelGroup" grouupId='<?= $group['id'] ?>'>
                    <div class="fst">
                        <p><?= $group['name'] ?></p>
                        <?= ($role == 'admin') ? '<a href="">+</a>' : '' ?>

                    </div>

                    <div class="snd">
                        <?php
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
        </div>
    <?php
            }
    ?>
    </div>
    <div class="serverChanelContent">
        <iframe id="chanelContent" src="" frameborder="0"></iframe>
    </div>

</body>


<!-- utilities -->
<div class="chanelsOptions">
    <a href="">Create chanel</a>
    <a href="">Modify chanels</a>
    <a href="">Create group</a>
    <a href="">Modify groups</a>
</div>

<!-- utilities -->
<div class="serverOptions">
    <?= ($role == 'admin') ? '<a href="">Server settings</a>' : '' ?>
    <?= ($role == 'admin') ? '<a href="">Manage users</a>' : '' ?>
    <a href="">Members</a>
    <a href="">Leave server</a>
</div>

<div id="tooltip"></div>

</html>

<script src="../assets/js/serverContent.js"></script>