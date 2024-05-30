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
                        <?= ($role == 'admin') ? '<a class="addServerInGroup" href="' . $group['id'] . '">+</a>' : '' ?>

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

    <div class="members">
        <h5>Members ~</h5>
        <?php
        foreach ($usersId as $userId) {
            //get server users
            $sql = 'SELECT * FROM users WHERE id = ' . $userId['userId'];
            $stmt = $conn->query($sql);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            //get user image
            $sql = 'SELECT * FROM `user-image` WHERE id = ' . $user['imageId'];
            $stmt = $conn->query($sql);
            $image = $stmt->fetch(PDO::FETCH_ASSOC);
        ?>
            <div class="userCard">
                <div class="user-photo" style="background-image: url('../assets/images/userImage/<?= $image['name'] ?>');"></div>
                <p><?= $user['username'] ?></p>
            </div>
        <?php
        }
        ?>
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

<!-- add chanel in selected group utility -->
<div id="postChanelUtility">
    <input type="hidden" name="chanelGroupIdToPost" id="chanelGroupIdToPost" value="">
    <input class="inputPostChanel" type="text" placeholder="Chanel name" name="chanelNameToPost" id="chanelNameToPost">
    <input class="inputPostChanel" type="text" placeholder="Chanel description" name="chanelDescriptionToPost" id="chanelDescriptionToPost">
    <p style="color: white;" class="big aux">CHANEL TYPE</p>
    <div name="chanelTypeToPost" id="chanelTypeToPost">
        <div id="typeHider"><p id="typeEmoji">📖</p></div>
        <p value="text">Text chanel</p>
        <p value="voice">Voice chanel</p>
    </div>
    <div>
        <button class="confirm big" id="createChanelInGroup">CREATE</button>
        <button class="delete big" id="CancelcreateChanelInGroup">CANCEL</button>
    </div>
</div>

<div id="tooltip"></div>

</html>

<script src="../assets/js/serverContent.js"></script>