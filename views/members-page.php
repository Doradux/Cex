<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/members-page.css">
    <title>Document</title>
</head>

<body>
    <h1><?= $_SESSION['currentServer']['name'] ?> MEMBERS</h1>
    <?php
    foreach ($members as $member) {
    ?>
        <div class="member">
            <div class="members-part1">
                <div class="member-image">
                    <img src="../assets/images/userImage/<?= $member['image'] ?>" alt="member image">
                </div>

                <div class="member-tags">
                    <p class="member-name-displayed <?= $member['serverRole'] == 'admin' ? 'blue' : '' ?>"><?= $member['name'] ?></p>
                    <p class="member-name-orginal soft">@<?= $member['username'] ?></p>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
</body>

</html>