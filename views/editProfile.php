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
                <input type="file" class="change-hover" accept="image/*" style="display: none;">
                <img class="change-hover" src="../assets/images/change-image.png" alt="change image">
            </label>
        </div>
        <button id="save-user-photo">Save</button>
        <div class="profile-data">
            <div class="public-data">

                <div class="section">
                    <p class="big">USERNAME</p>
                    <div class="zntal">
                        <input id="username-input" disabled type="text" class="no-editable" value="<?= $_SESSION['currentUser']['username'] ?>">
                        <button class="edit-username" id="edit-username">EDIT</button>
                        <button class="save-btn" id="save-username">SAVE</button>
                    </div>
                </div>

                <div class="section">
                    <p class=" big">DISPLAYNAME</p>
                    <div class="zntal">
                        <input id="displayname-input" disabled class="no-editable" value="<?= $_SESSION['currentUser']['displayname'] == null ? 'None' : $_SESSION['currentUser']['displayname'] ?>">
                        <button id="edit-displayname">EDIT</button>
                        <button class="save-btn" id="save-displayname">SAVE</button>
                    </div>
                </div>

                <div class="section">
                    <p class="big">EMAIL</p>
                    <div class="zntal">
                        <div class="mail">
                            <p id="cover" class="cover"><?= $cover ?>.</p>
                            <p class="no-editable"><?= $_SESSION['currentUser']['email'] ?></p>
                        </div>
                        <button id="show">REVEAL</button>
                    </div>
                </div>

                <div class="section">
                    <p class="big">DATE BIRTH</p>
                    <div class="zntal">
                        <input id="birth-input" disabled class="no-editable" value="<?= $_SESSION['currentUser']['birth'] ?>">
                        <button id="edit-birth">EDIT</button>
                        <button class="save-btn" id="save-birth">SAVE</button>
                    </div>
                </div>
            </div>


            <div class="more">
                <button id="showCancelDiv" class="orange-btn">CHANGE PASSWORD</button>
                <button id="sign-out" class="red-btn">SIGN OUT</button>
                <button id="delete-account-show" class="red-btn">DELETE ACCOUNT</button>
            </div>

        </div>
    </div>

    <?php
    //change password
    include '../assets/components/changePassword.php';
    //delete account
    include '../assets/components/delete-account.php';
    ?>
</body>

</html>

<script src="../assets/js/editProfile.js"></script>