<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/delete-server.css">

    <title>Document</title>
</head>

<body>
    <div class="delete-div">
        <p class="big"><span class="red">DELETE SERVER</span> <?= $_SESSION['currentServer']['name'] ?></p>
        <div class="text">
            <p><span class="warning">WARNING!</span> You can't undo this action, all content of the server will be deleted.</p>
            <p>Type <span class="type">I UNDERSTAND</span> to proceed.</p>
        </div>
        <input type="text" id="confirmKey">
        <button class="big" id="delete-server">DELETE SERVER</button>
    </div>
</body>

<script src="../assets/js/delete-server.js"></script>

</html>