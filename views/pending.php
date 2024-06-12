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

</html>