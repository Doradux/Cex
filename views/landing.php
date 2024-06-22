<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/landing.css">
    <title>Landing</title>
</head>

<body>
    <header>
        <div class="inf">
            <img src="../assets/icons/friends.png" alt="friends icon">
            <p>Friends</p>
        </div>
        <div class="sections">
            <p class="section friends-section">All</p>
            <?php
            if (count($_SESSION['pendings']) > 0) {
            ?>
                <p class="section pending-section darkcyan">Pending</p>
            <?php
            } else {
            ?>
                <p class="section pending-section">Pending</p>
            <?php
            }
            ?>
            <p class="section add-section">Add friend</p>
            <p class="section public-servers-section">Public servers</p>
            <div class="help"><img src="../assets/icons/faq.png" alt="faq"></div>
        </div>
    </header>

    <div class="iframe">
        <iframe id="iframe" src="../controller/contacts.php" frameborder="0"></iframe>
    </div>
</body>

<script src="../assets/js/landing.js"></script>

</html>