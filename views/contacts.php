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

</html>