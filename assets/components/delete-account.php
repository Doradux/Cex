<div class="delete-account-shield">
    <div class="delete-account">
        <p>Delete account</p>
        <div class="delete-account-warning">
            <p><span id="warning">WARNING!</span> You won't be able to access this account ever again. Your messages on the servers will be kept and your servers will be deleted too.</p>
            <p>Type <span id="lit">I UNDERSTAND</span> and then click on "DELETE ACCOUNT" to proceed.</p>
            <input type="text" id="confirm-delete" placeholder="I UNDERSTAND">
        </div>
        <div class="delete-btns">
            <button class="confirm-delete-btn" id="delete-confirm-disabled">DELETE ACCOUNT</button>
            <button id="delete-cancel">CANCEL</button>
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

    .delete-account-shield {
        width: 100vw;
        height: 100vh;
        background-color: rgba(0, 0, 0, 0.7);
        display: none;
        justify-content: center;
        align-items: center;
        position: absolute;
        backdrop-filter: blur(5px);
    }

    .delete-account {
        color: white;
        position: absolute;
        top: 35%;
        right: 40%;
        display: flex;
        flex-direction: column;
        padding: 10px;
        width: 400px;
        border-radius: 10px;
        gap: 20px;
        background-color: rgb(70, 70, 70);
    }

    #warning {
        font-family: 'poppins_bold';
        color: crimson;
    }

    .delete-account-warning {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .delete-btns {
        display: flex;
        gap: 10px;
        justify-content: end;
    }

    button {
        padding: 5px;
        font-family: 'poppins_bold';
        border: none;
        border-radius: 5px;
        transition: all 0.3s ease;
    }

    button:hover {
        cursor: pointer;
    }

    #lit {
        font-family: 'poppins_bold';
        font-style: italic;
        color: green;
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

    #delete-confirm {
        color: black;
        background-color: crimson;
    }

    #delete-confirm:hover {
        background-color: darkred;
        color: white;
    }

    #delete-cancel {
        color: black;
        background-color: orange;
    }

    #delete-cancel:hover {
        background-color: darkgoldenrod;
        color: white;
    }

    #delete-confirm-disabled {
        color: rgb(50, 50, 50);
        background-color: gray;
        cursor: not-allowed;
    }
</style>