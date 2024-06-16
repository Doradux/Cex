<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assets/css/contacts.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacts</title>

</head>

<body>
    <?php
    if (count($friends) > 0) {
        echo "<div class='friends'>";
        foreach ($_SESSION['friends'] as $userFriend) {
    ?>
            <div class="friend">
                <div class="fst">
                    <div class="fst-fst">
                        <figure>
                            <img src="../assets/images/userImage/<?= $userFriend['image'] ?>" alt="friend image">
                        </figure>
                        <div class="names">
                            <h3>@<?= $userFriend['username'] ?></h3>
                            <p><?= $userFriend['displayname'] ?></p>
                        </div>
                    </div>
                    <div class="fst-snd">
                        <p><?= $userFriend['status'] ?></p>
                    </div>
                </div>
                <div class="snd">
                    <div class="option msg" userId="<?= $userFriend['id'] ?>">
                        <img src="../assets/icons/msg.png" alt="chat user">
                    </div>
                    <div userId="<?= $userFriend['id'] ?>" class="option delete">
                        <img src="../assets/icons/delete.png" alt="delete friend">
                    </div>
                </div>
            </div>
        <?php
        }
        echo "</div>";
    } else {
        ?>

        <div class="no-friends">
            <img src="../assets/images/lonely.png" alt="lonely image">
            <p>It's very lonely here...</p>
        </div>

        <style>
            body {
                justify-content: center;
                align-items: center;
                text-align: center;
            }
        </style>

    <?php
    }
    ?>
</body>

<script src="../assets/js/contacts.js"></script>

</html>