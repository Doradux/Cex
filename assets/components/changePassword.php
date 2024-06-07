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

<style>
    .change-password {
        color: white;
        position: absolute;
        top: 35%;
        right: 40%;
        background-color: rgb(50, 50, 50);
        display: none;
        flex-direction: column;
        padding: 10px;
        width: 300px;
        border-radius: 10px;
        gap: 20px;
        /* box-shadow: 0 2px 20px 0px rgb(88, 88, 88); */
    }

    input {
        background-color: rgb(70, 70, 70);
        border-radius: 5px;
        border: none;
        color: white;
        padding: 5px;
        font-size: 1rem;
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