<div class="password-shield">
    <div class="change-password">
        <p>Change password</p>
        <input type="password" id="old-password" placeholder="Current password">
        <div class="new-password">
            <input type="password" id="new-password" placeholder="New password">
            <input type="password" id="confirm-password" placeholder="Confirm password">
        </div>
        <div class="password-btns">
            <button class="save-pass-btn" style="display: block;" id="save-password">SAVE</button>
            <button class="cancel-pass-btn" style="display: block;" id="cancel-password">CANCEL</button>
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

    .password-shield {
        width: 100vw;
        height: 100vh;
        background-color: rgba(0, 0, 0, 0.7);
        display: none;
        justify-content: center;
        align-items: center;
        position: fixed;
        top: 0;
        left: 0;
        backdrop-filter: blur(5px);
    }

    .change-password {
        color: white;
        position: absolute;
        top: 35%;
        right: 40%;
        display: flex;
        flex-direction: column;
        padding: 10px;
        width: 300px;
        border-radius: 10px;
        gap: 20px;
        background-color: rgb(70, 70, 70);
        /* box-shadow: 0 2px 20px 0px rgb(88, 88, 88); */
    }

    input {
        background-color: rgb(50, 50, 50);
        border-radius: 5px;
        border: none;
        color: white;
        padding: 5px;
        font-size: 1rem;
    }

    input::placeholder {
        color: rgba(255, 255, 255, 0.7);
    }

    input:focus {
        outline: none;
    }

    .new-password {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .password-btns {
        display: flex;
        justify-content: space-around;
    }

    .save-pass-btn {
        min-width: 70px;
        background-color: greenyellow;
        border: none;
        border-radius: 5px;
        box-shadow: 0 1px 2px 0 rgb(88, 88, 88);
        font-family: "poppins_bold";
        color: black;
        cursor: pointer;
        text-align: center;
        font-size: 0.9rem;
        display: none;
        padding: 5px;
    }

    .save-pass-btn:hover {
        color: white;
        background-color: green;
    }

    .cancel-pass-btn {
        background-color: crimson;
        color: black;
    }

    .cancel-pass-btn:hover {
        background-color: darkred;
        color: white;
    }
</style>