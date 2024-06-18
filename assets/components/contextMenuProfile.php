<div class="userProfileShield" id="user-profile-shield">

    <div class="userProfile" id="user-profile">
        <div class="profile-blue"></div>
        <div class="profile-image">
            <img src='../../assets/images/userImage/<?= $_SESSION['currentUser']['userImg'] ?>' class="profile-image-icon" alt="userImage">
        </div>
        <div class="profile-data">
            <div class="datapart">
                <p class="big">@<?= $_SESSION['currentUser']['username'] ?></p>
                <p><?= $_SESSION['currentUser']['displayname'] ?></p>
            </div>
            <div class="datapart">
                <p class="big">Member since</p>
                <p><?= $_SESSION['currentUser']['creation'] ?></p>
            </div>
        </div>
        <div class="profile-options">
            <p id="set-status-btn">😀 SET CUSTOM STATUS</p>
            <div id="edit-profile-btn">
                <p id="settings-emoji">⚙️</p>
                <p class="profile-settings-btn">PROFILE SETTINGS</p>
            </div>
        </div>
    </div>
</div>

<style>
    @font-face {
        font-family: "poppins";
        src: url("../../assets/fonts/Poppins-Regular.ttf");
        font-weight: normal;
        font-style: normal;
    }

    @font-face {
        font-family: "poppins_bold";
        src: url("../../assets/fonts/Poppins-Bold.ttf");
        font-weight: normal;
        font-style: normal;
    }

    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        /* border: 1px solid black; */
        font-family: "poppins";
        cursor: default;
    }

    .userProfile {
        border-radius: 10px;
        overflow: hidden;
        width: 200px;
        height: 350px;
        background-color: rgb(20, 20, 20);
        color: white;
        display: flex;
        flex-direction: column;
        position: absolute;
        padding-bottom: 10px;
    }

    .profile-blue {
        background-color: darkcyan;
        width: 100%;
        height: 50px;
    }

    .profile-image {
        width: 80px;
        height: 80px;
        transform: translateY(-25px) translateX(10px);
        border-radius: 100%;
        display: flex;
        align-items: center;
        justify-content: center;

        & img {
            border: 3px solid rgb(40, 40, 40);
        }
    }

    .profile-image-icon {
        width: 90%;
        height: 90%;
        background-position: center center;
        background-size: cover;
        border-radius: 100%;
    }

    .profile-options {
        display: flex;
        flex-direction: column;
        justify-content: space-around;
        height: 140px;
        font-size: 0.9rem;
    }

    .profile-options p {
        font-family: "poppins_bold";
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 5px;
    }

    .profile-options p:hover {
        color: darkcyan;
        cursor: pointer;
    }

    .profile-data {
        display: flex;
        flex-direction: column;
        margin-top: -25px;
        border-bottom: 3px solid darkcyan;
        padding-bottom: 10px;
    }

    .big {
        font-size: 1.1rem;
        font-weight: bold;
    }

    .datapart {
        padding: 10px;
        display: flex;
        flex-direction: column;
    }

    .userProfileShield {
        width: 100vw;
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        display: none;
    }
</style>


<script>
    var userIcon = document.getElementById('prof');
    var userOptionsMenu = document.getElementById('user-profile')
    var userOptionsShield = document.getElementById('user-profile-shield')


    //open user data menu
    userIcon.addEventListener("click", function(event) {
        userOptionsShield.style.display = "flex";

        var screenSize = window.innerWidth;
        if (screenSize > 800) {
            userOptionsMenu.style.left = "30px";
            userOptionsMenu.style.bottom = "60px";
        } else {
            userOptionsMenu.style.left = "calc(50vw - 100px)";
            userOptionsMenu.style.bottom = "70px";
        }

    })

    userOptionsShield.addEventListener("click", function(event) {
        if (!event.target.closest(".userProfile")) {
            userOptionsShield.style.display = "none";
        }

        if (event.target.closest(".profile-settings-btn")) {
            userOptionsShield.style.display = "none";
        }
    })

    //go to edit profile
    var editProfileBtn = document.getElementById("edit-profile-btn");
    editProfileBtn.addEventListener("click", function() {
        userOptionsShield.style.display = "none";
        iframe.src = "../controller/editProfile.php";
    });
</script>