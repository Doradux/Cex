<div class="kick-member-shield">
    <div class="kick-member-div">
        <p>Do you want to kick <span id="kick-nick" class="gold"></span>?</p>
        <input type="hidden" id="kick-member-id">
        <div class="kick-member-btns">
            <button id="confirm-kick">CONFIRM</button>
            <button id="cancel-kick">CANCEL</button>
        </div>
    </div>
</div>

<style>
    .kick-member-shield {
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

    .kick-member-div {
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
    }

    .gold {
        color: goldenrod;
        font-family: 'poppins_bold';
    }

    .kick-member-btns {
        display: flex;
        justify-content: end;
        gap: 10px;
    }

    button {
        min-width: 70px;
        background-color: rgb(0, 140, 255);
        border: none;
        border-radius: 5px;
        box-shadow: 0 1px 2px 0 rgb(88, 88, 88);
        font-family: "poppins_bold";
        color: white;
        cursor: pointer;
        transition: all 0.3s ease;
        padding: 5px;
    }

    #confirm-kick {
        background-color: greenyellow;
        border: none;
        border-radius: 5px;
        box-shadow: 0 1px 2px 0 rgb(88, 88, 88);
        font-family: "poppins_bold";
        color: black;
        cursor: pointer;
        text-align: center;
    }

    #confirm-kick:hover {
        color: white;
        background-color: green;
    }

    #cancel-kick {
        background-color: crimson;
        color: black;
    }

    #cancel-kick:hover {
        background-color: darkred;
        color: white;
    }
</style>