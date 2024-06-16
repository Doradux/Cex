<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/public-servers.css">
    <title>Document</title>
</head>

<body>
    <div class="servers">
        <?php
        foreach ($servers as $server) {
            $stmt->bindParam("serverId", $server['id']);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $members = count($result)
        ?>
            <div class="server">
                <div class="grand-image" style="background-image: url('../assets/images/grandImage/<?= $server['grandImageName'] ?>');"></div>
                <div class="image" style="background-image: url('../assets/images/serverImage/<?= $server['imageName'] ?>');"></div>
                <p class="name"><?= $server['name'] ?></p>
                <div class="info">
                    <div class="members">
                        <img src="../assets/icons/members.png" alt="members count">
                        <p><?= $members ?></p>
                    </div>
                    <button class="copyLink" onclick="getLink('<?= $server['dinamicId'] ?>')">COPY LINK</button>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</body>

<script src="../assets/js/public-servers.js"></script>

</html>