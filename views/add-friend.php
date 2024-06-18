<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/add-friend.css">
    <title>Add friend</title>
</head>

<body>
    <div class="p1">
        <div class="info">
            <h2>ADD FRIEND</h2>
            <P>You can add friends with their Cex username.</P>
        </div>
        <div class="add-friend-div">
            <p>@</p>
            <input type="text" id="send-input" placeholder="Username">
            <button onclick="searchUsers()" id="send-btn" disabled>SEND</button>
        </div>

        <div class="results">

        </div>
    </div>

    <div class="p2">
        <div class="info">
            <h2>SENT REQUESTS</h2>
            <p>Users who you sent a request.</p>
        </div>
        <?php
        if (count($sentUsersData) > 0) {
            foreach ($sentUsersData as $sentUserData) {
        ?>
                <div class="sent">
                    <div class="fst">
                        <figure><img src="../assets/images/userImage/<?= $sentUserData['image'] ?>" alt="user image"></figure>
                        <div class="names">
                            <p>@<?= $sentUserData['username'] ?></p>
                            <p><?= $sentUserData['displayname'] ?></p>
                        </div>
                    </div>
                    <div class="snd" userId="<?= $sentUserData['id'] ?>">
                        <p>x</p>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    </div>
</body>

<script src="../assets/js/add-friend.js"></script>

</html>