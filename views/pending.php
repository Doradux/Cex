<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assets/css/pending.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacts</title>

</head>

<body>
    <?php
    if (count($pendings) > 0) {
        echo "<div class='pendings'>";
        foreach ($pendings as $pending) {
    ?>

            <div class="pending">
                <div class="fst">
                    <img src="../assets/images/userImage/<?= $pending['image'] ?>" alt="user image">
                    <div class="nicks">
                        <p>@<?= $pending['username'] ?></p>
                        <p><?= $pending['displayname'] ?></p>
                    </div>
                </div>
                <div class="snd">
                    <div class="action accept" userId="<?= $pending['id'] ?>">
                        <img src="../assets/icons/accept-friend.png" alt="accept">
                    </div>
                    <div class="action refuse" userId="<?= $pending['id'] ?>">
                        <img src="../assets/icons/refuse-friend.png" alt="refuse">
                    </div>
                </div>
            </div>

        <?php
        }
        echo "</div>";
    } else {
        ?>

        <div class="no-friends">
            <img src="../assets/images/pending.png" alt="pending image">
            <p>You have no pending requests</p>
        </div>

        <style>
            body {
                justify-content: center;
                align-items: center;
                text-align: center;
                gap: 20px;

                & img {
                    width: 120px;
                }
            }
        </style>

    <?php
    }
    ?>
</body>

<script src="../assets/js/pending.js"></script>

</html>