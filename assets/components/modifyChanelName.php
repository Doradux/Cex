<div class="modify-chanel-shield">
    <div class="modify-chanel">
        <p>Edit chanel name</p>
        <input type="text" id="newName" placeholder="New chanel name">
        <div class="btns">
            <button id="confirmModify">ACEPTAR</button>
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
    }

    .modify-chanel-shield {
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

    button {
        cursor: pointer;
    }

    .modify-chanel {
        background-color: rgb(50, 50, 50);
        padding: 20px;
        display: flex;
        flex-direction: column;
        gap: 10px;
        border-radius: 10px;
    }

    .btns {
        display: flex;
        justify-content: end;
    }

    button {
        background-color: limegreen;
        padding: 8px;
        font-family: 'poppins_bold';
        transition: all 0.3s ease;
        color: black;
        border-radius: 8px;
        border: none;
    }

    button {
        color: while;
        background-color: mediumseagreen;
    }

    input {
        padding: 8px;
        background-color: rgb(30, 30, 30);
        border-radius: 8px;
        border: none;
    }

    input:focus {
        outline: none;
    }
</style>