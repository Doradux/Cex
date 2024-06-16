<div class="confirmLeaveServer-shield">
    <div class="confirmLeaveServer">
        <p>Leave <span><?= $_SESSION['currentServer']['name'] ?></span>?</p>
        <div class="confirmLeaveServer-btns">
            <button class="confirmLeaveServer-btn btn-confirm">CONFIRM</button>
            <button class="confirmLeaveServer-btn btn-cancel">CANCEL</button>
        </div>
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

    .confirmLeaveServer-shield {
        width: 100vw;
        height: 100vh;
        display: none;
        justify-content: center;
        align-items: center;
        position: fixed;
        top: 0;
        left: 0;
        background-color: rgba(0, 0, 0, 0.7);
        backdrop-filter: blur(5px);
    }

    .confirmLeaveServer {
        color: white;
        background-color: rgb(50, 50, 50);
        display: flex;
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