<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/text_chanel.css">
    <title>Document</title>
</head>

<body>
    <header>
        <div class="chanel-title"># <?= $chanelData['name'] ?></div>
        <div class="chanel-description"><?= $chanelData['description'] ?></div>
    </header>

    <?php
    $lastDate = null;

    foreach ($messages as $message) {
        $currentDate = date('d/m/Y', strtotime($message['time']));

        if ($currentDate != $lastDate) {
            echo "<p class='dateMsg'>$currentDate</p>";
            $lastDate = $currentDate;
        }

        if ($message['userId'] == $_SESSION['currentUser']['id']) {
    ?>
            <div class="message" style="align-items: end;">
                <div class="out-msg-content">
                    <p class="messageContent msg"><?= $message['content'] ?></p>
                    <p class="in-time"><?= date('H:i', strtotime($message['time'])) ?></p>
                </div>
            </div>
        <?php
        } else if ($message['userId'] == 0) {
        ?>

            <div class="in-msg centred">
                <p class="messageContent"><?= $message['content'] ?></p>
            </div>
        <?php
        } else {

            //get sender name and img
            $sql = 'SELECT * FROM `users` WHERE id = :userId';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":userId", $message['userId']);
            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    $senderData = $stmt->fetch(PDO::FETCH_ASSOC);
                    $sql = 'SELECT * FROM `user-image` WHERE id = :imageId';
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(":imageId", $senderData['imageId']);
                    if ($stmt->execute()) {
                        $senderImg = $stmt->fetch(PDO::FETCH_ASSOC);
                    }
                } else {
                    $senderData['id'] = 0;
                    $senderImg['name'] = "default.jpg";
                    $senderData['username'] = '(Deleted user)';
                }
            }

        ?>
            <div class="in-msg">
                <div class="in-sender">
                    <div class="in-photo" style="background-image: url('../assets/images/userImage/<?= $senderImg['name'] ?>');"></div>
                    <?php
                    $found = false;
                    foreach ($_SESSION['serverUsers'] as $serUser) {
                        if ($serUser['id'] == $senderData['id']) {
                            $found = true;
                            $senderName = $serUser['name'];
                            break;
                        } else {
                            $senderName = "Deleted user";
                        }
                    }
                    if (!$found) {
                        $senderName = $senderData['username'];
                    }
                    ?>
                    <p class="in-name"><?= $senderName ?></p>
                </div>
                <div class="in-msg-content msg">
                    <p class="messageContent"><?= $message['content'] ?></p>
                    <p class="in-time"><?= date('H:i', strtotime($message['time'])) ?></p>
                </div>
            </div>
    <?php
        }
    }
    ?>


    <div class="sendMsg">
        <div class="uploadPhoto">+</div>
        <input placeholder="Message #<?= $chanelData['name'] ?>" type="text" name="sendMsg" id="sendMsg">
        <input type="hidden" id="chanelId" value="<?= $chanelData['id'] ?>">
        <div class="confirmSendMsg">
            <img src="../assets/images/send.svg" alt="sendMessage">
        </div>
    </div>
</body>

</html>

<script src="../assets/js/text_chanel.js"></script>