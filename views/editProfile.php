<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/editProfile.css">
    <title>Document</title>
</head>

<body>
    <h1>My account</h1>

    <div class="userProfile" id="user-profile">
        <div class="profile-blue"></div>
        <div class="profile-image">
            <img id="user-image" src='../../assets/images/userImage/<?= $_SESSION['currentUser']['userImg'] ?>' class="profile-image-icon" alt="userImage">
            <label class="change-image-hover">
                <input type="file" name="change-hover" accept="image/*" style="display: none;">
                <img class="change-hover" src="../assets/images/change-image.png" alt="change image">
            </label>
        </div>
        <button id="save-user-photo">Save</button>
        <div class="profile-data">
            <div class="public-data">

                <div class="section">
                    <p class="big">USERNAME</p>
                    <div class="zntal">
                        <p><?= $_SESSION['currentUser']['username'] ?></p>
                        <button>EDIT</button>
                    </div>
                </div>

                <div class="section">
                    <p class=" big">DISPLAYNAME</p>
                    <div class="zntal">
                        <p><?= $_SESSION['currentUser']['displayname'] == null ? 'None' : $_SESSION['currentUser']['displayname'] ?></p>
                        <button>EDIT</button>
                    </div>
                </div>

                <div class="section">
                    <p class="big">EMAIL</p>
                    <div class="zntal">
                        <div class="mail">
                            <p id="cover" class="cover"><?= $cover ?>.</p>
                            <p><?= $_SESSION['currentUser']['email'] ?></p>
                            <button id="show">REVEAL</button>
                        </div>
                        <button>EDIT</button>
                    </div>
                </div>

                <div class="section">
                    <p class="big">DATE BIRTH</p>
                    <div class="zntal">
                        <p><?= $_SESSION['currentUser']['birth'] ?></p>
                        <button>EDIT</button>
                    </div>
                </div>
            </div>


            <div class="more">
                <button class="orange-btn">CHANGE PASSWORD</button>
                <button class="red-btn">SIGN OUT</button>
                <button class="red-btn">DELETE ACCOUNT</button>
            </div>

        </div>
    </div>
</body>

</html>

<script src="../assets/js/editProfile.js"></script>