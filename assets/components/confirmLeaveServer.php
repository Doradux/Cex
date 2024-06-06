<div class="confirmLeaveServer">
    <p>Leave <span><?= $_SESSION['currentServer']['name'] ?></span>?</p>
    <div class="confirmLeaveServer-btns">
        <button class="confirmLeaveServer-btn btn-confirm">CONFIRM</button>
        <button class="confirmLeaveServer-btn btn-cancel">CANCEL</button>
    </div>
</div>

<style>
    @font-face {
        font-family: "poppins";
        src: url("../assets/fonts/Poppins-Regular.ttf");
        font-weight: normal;
        font-style: normal;
    }

    @font-face {
        font-family: "poppins_bold";
        src: url("../assets/fonts/Poppins-Bold.ttf");
        font-weight: normal;
        font-style: normal;
    }

    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        /* border: 1px solid black; */
        font-family: "poppins";
    }

    .confirmLeaveServer {
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
    }

    span {
        font-family: 'poppins_bold';
    }

    .confirmLeaveServer-btns {
        display: flex;
        gap: 10px;
        justify-content: end;
    }

    .confirmLeaveServer-btns button:hover {
        color: white;
    }

    .confirmLeaveServer-btn {
        padding: 5px;
        border-radius: 5px;
        background-color: transparent;
        border: none;
        font-family: 'poppins_bold';
        transition: all 0.3s ease;
    }

    .btn-confirm {
        background-color: greenyellow;
    }

    .btn-confirm:hover {
        background-color: green;
    }

    .btn-cancel {
        background-color: crimson;
    }

    .btn-cancel:hover {
        background-color: darkred;
    }
</style>