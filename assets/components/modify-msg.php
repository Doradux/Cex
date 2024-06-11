<div class="modify-msg-shield">
    <div class="modify-msg-div">
        <p>Modify message</p>
        <textarea class="modify-content"></textarea>
        <div class="modify-btns">
            <button id="modify-save">SAVE</button>
            <button id="modify-del">CANCEL</button>
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
        cursor: default;
    }

    .modify-msg-shield {
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

    .modify-msg-div {
        background-color: rgb(50, 50, 50);
        padding: 10px;
        color: white;
        display: flex;
        flex-direction: column;
        gap: 10px;
        border-radius: 10px;
    }

    textarea {
        border: none;
        background-color: rgb(70, 70, 70);
        width: 400px;
        height: 200px;
        resize: none;
        color: white;
        padding: 10px;
    }

    textarea:focus {
        outline: none;
    }

    .modify-btns {
        display: flex;
        gap: 10px;
        justify-content: end;
    }

    button {
        background-color: greenyellow;
        padding: 5px;
        font-family: 'poppins_bold';
        border: none;
        border-radius: 5px;
        transition: all 0.3s ease;
    }

    #modify-del {
        background-color: rgb(30, 30, 30);
        color: crimson;
    }

    #modify-del:hover {
        color: white;
        background-color: crimson;
    }
</style>