<div class="modify-nickname-shield">
    <div class="modify-nickname">
        <p id="modify-p"></p>
        <input id="nick-input" type="text" placeholder="New server nick">
        <input type="hidden" id="id-input" value="">
        <div class="modify-btns">
            <button class="save-btn">CHANGE NICK</button>
            <button class="cancel-btn">CANCEL</button>
        </div>
    </div>
</div>

<style>
    .modify-nickname-shield {
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

    .modify-nickname {
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

    .gold {
        color: goldenrod;
        font-family: 'poppins_bold';
    }

    .modify-btns {
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

    .save-btn {
        background-color: greenyellow;
        border: none;
        border-radius: 5px;
        box-shadow: 0 1px 2px 0 rgb(88, 88, 88);
        font-family: "poppins_bold";
        color: black;
        cursor: pointer;
        text-align: center;
    }

    .save-btn:hover {
        color: white;
        background-color: green;
    }

    .cancel-btn {
        background-color: crimson;
        color: black;
    }

    .cancel-btn:hover {
        background-color: darkred;
        color: white;
    }
</style>