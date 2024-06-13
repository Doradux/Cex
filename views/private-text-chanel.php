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
        <div class="chanel-title">@<?= $friendData['name'] ?></div>
    </header>

    <?php
    $messages = $_SESSION['msgs'];
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
                <div class="out-msg-content msg" senderId="<?= $message['userId'] ?>" messageId="<?= $message['id'] ?>">
                    <p class="messageContent"><?= $message['content'] ?></p>
                    <p class="in-time"><?= $message['modified'] == 1 ? 'Modified ' : '' ?><?= date('H:i', strtotime($message['time'])) ?></p>
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
        ?>
            <div class="in-msg">
                <div class="in-sender">
                    <div class="in-photo" style="background-image: url('../assets/images/userImage/<?= $friendData['image'] ?>');"></div>
                    <p class="in-name"><?= $friendData['username'] ?></p>
                </div>
                <div class="in-msg-content msg" senderId="<?= $message['userId'] ?>" messageId="<?= $message['id'] ?>">
                    <p class="messageContent"><?= $message['content'] ?></p>
                    <p class="in-time"><?= $message['modified'] == 1 ? 'Modified ' : '' ?><?= date('H:i', strtotime($message['time'])) ?></p>
                </div>
            </div>
    <?php
        }
    }
    ?>


    <div class="sendMsg">
        <div class="uploadPhoto">+</div>
        <input placeholder="Message @<?= $friendData['name'] ?>" type="text" name="sendMsg" id="sendMsg">
        <input type="hidden" id="chanelId" value="<?= $chanelData['id'] ?>">
        <div class="confirmSendMsg">
            <img src="../assets/images/send.svg" alt="sendMessage">
        </div>
    </div>

    <?php
    //component msg-context-menu
    include '../assets/components/msg-context-menu.php';
    //component msg-modify
    include '../assets/components/modify-msg.php';
    ?>
</body>

</html>

<script>
    var role = "user";
    let currentId = "<?= $_SESSION['currentUser']['id'] ?>";
</script>
<script src="../assets/js/text_chanel.js"></script>