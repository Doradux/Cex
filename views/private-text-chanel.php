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
        <div class="chanel-title">@<?= $friendData['username'] ?></div>
    </header>

    <div class="start">
        <h1>Beginning of @<?= $friendData['username'] ?> chat</h1>
    </div>

    <div id="msgs-container" class="msgs-container"></div>


    <div class="sendMsg">
        <input placeholder="Message #<?= $chanelData['name'] ?>" type="text" name="sendMsg" id="sendMsg">
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    var role = "<?= $_SESSION['currentUser']['role'] ?>";
    var currentId = "<?= $_SESSION['currentUser']['id'] ?>";
    let chanelId = "<?= $chanelData['id'] ?>";
    var msgContextMenuShield = document.querySelector(".msg-context-menu-shield");
    var modifyMessageDiv = document.querySelector(".modify-msg-div");
</script>
<script src="../assets/js/chat.js"></script>
<script src="../assets/js/text_chanel.js"></script>