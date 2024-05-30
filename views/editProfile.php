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
            <img class="profile-image-icon" src="../../assets/images/userImage/default.png" alt="userImage">
        </div>
        <div class="profile-data">
            <div class="public-data">

                <div class="section">
                    <p class="big">USERNAME</p>
                    <div class="zntal">
                        <p><?= $_SESSION['currentUser']['username'] ?></p>
                        <button>Edit</button>
                    </div>
                </div>

                <div class="section">
                    <p class=" big">DISPLAYNAME</p>
                    <div class="zntal">
                        <p><?= $_SESSION['currentUser']['displayname'] == null ? 'None' : $_SESSION['currentUser']['displayname'] ?></p>
                        <button>Edit</button>
                    </div>
                </div>

                <div class="section">
                    <p class="big">EMAIL</p>
                    <div class="zntal">
                        <div class="mail">
                            <p id="cover" class="cover"><?= $cover ?></p>
                            <p><?= $_SESSION['currentUser']['email'] ?></p>
                            <button id="show">Show</button>
                        </div>
                        <button>Edit</button>
                    </div>
                </div>

                <div class="section">
                    <p class="big">DATE BIRTH</p>
                    <div class="zntal">
                        <p><?= $_SESSION['currentUser']['birth'] ?></p>
                        <button>Edit</button>
                    </div>
                </div>
            </div>


            <div class="more">
                <button>Change Password</button>
                <button>Delete Account</button>
                <button class="red-btn">Sign Out</button>
            </div>

        </div>
    </div>
</body>

</html>

<script src="../assets/js/editProfile.js"></script>